<?php

namespace App\Http\Controllers;

use App\Models\Campaña;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CampañaController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        $usuario = Auth::user();
        $campañas = Campaña::whereHas('creadores', function ($query) use ($usuario) {
            $query->where('users.id', $usuario->id);
        })->orWhereHas('jugadores', function ($query) use ($usuario) {
            $query->where('users.id', $usuario->id);
        })->paginate(3);
    } else {
        $campañas = Campaña::paginate(3);
    }

    return view('campañas.index', compact('campañas'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Genera un código aleatorio de 16 caracteres
        $codigo = Str::random(16);

        // Crea una nueva campaña con los datos recibidos y el código generado
        $campaña = new Campaña();
        $campaña->nombre = $request->nombre;
        $campaña->codigo = $codigo;

        // Asigna el ID del usuario autenticado como el creador de la campaña
        $campaña->save();

        // Asocia al usuario autenticado como creador de la campaña
        $campaña->creadores()->attach(Auth::id());

        $this->crearChatsYUnirse($campaña);

        return redirect()->route('campañas.index')->with('success', '¡Campaña creada con éxito!');
    }

    public function unirse(Request $request)
{
    $request->validate([
        'codigo_campaña' => 'required|string|max:255',
    ]);

    $codigo_campaña = $request->codigo_campaña;

    $campaña = Campaña::where('codigo', $codigo_campaña)->first();

    if (!$campaña) {
        return redirect()->back()->with('error', 'Código de campaña inválido.');
    }

    $usuario = Auth::user();

    // Verificar si el usuario es el creador de la campaña
    if ($campaña->creadores()->first()->id === $usuario->id) {
        return redirect()->back()->with('error', 'Ya eres el creador de esta campaña.');
    }

    if ($campaña->jugadorEnCampaña($usuario->id)) {
        return redirect()->back()->with('error', 'Ya estás en esta campaña.');
    }

    // Si no es el creador ni está en la campaña, agregarlo
    $campaña->jugadores()->attach($usuario);

    // Crear los chats privados "Diario de Nombre de usuario" y "Masterchat Nombre de usuario"
    $diarioChat = Chat::crear('Diario de ' . $usuario->name, $campaña->id);
    $masterChat = Chat::crear('Masterchat ' . $usuario->name, $campaña->id);

    // Unir al usuario a los chats privados con permisos de hablar
    $diarioChat->unirseAChat($usuario, true);
    $masterChat->unirseAChat($usuario, true);

    // Unir al creador de la campaña a los chats privados con permisos de hablar
    $creador = $campaña->creadores()->first();
    $diarioChat->unirseAChat($creador, true);
    $masterChat->unirseAChat($creador, true);

    // Unir al usuario a los chats generales sin permisos para hablar
    $generalChat = $campaña->chats()->where('nombre', 'General')->first();
    $recursosChat = $campaña->chats()->where('nombre', 'Recursos')->first();
    $npcChat = $campaña->chats()->where('nombre', 'Npc')->first();

    $generalChat->unirseAChat($usuario, false);
    $recursosChat->unirseAChat($usuario, false);
    $npcChat->unirseAChat($usuario, false);

    return redirect()->back()->with('success', 'Te has unido a la campaña exitosamente.');
}

public function show($id)
{
    // Obtener la campaña
    $campaña = Campaña::findOrFail($id);

    // Obtener los chats asociados con la campaña
    $chats = $campaña->chats;

    // Filtrar los chats generales
    $chatsGenerales = $chats->filter(function ($chat) {
        return in_array($chat->nombre, ['General', 'Recursos', 'Npc']);
    });

    // Filtrar los chats de jugadores
    $chatsJugadores = $chats->filter(function ($chat) {
        return (strpos($chat->nombre, 'Masterchat') === 0 || strpos($chat->nombre, 'Diario') === 0) &&
            $chat->usuarios->contains(Auth::user());
    });

    // Obtener todos los usuarios asociados con la campaña
    $usuarios = User::whereIn('id', $campaña->jugadores()->pluck('user_id'))->get();

    // Obtener los jugadores de la campaña
    $jugadores = $usuarios->intersect($campaña->jugadores);

    // Obtener los creadores de la campaña
    $creadores = $usuarios->intersect($campaña->creadores);

    return view('campañas.show', compact('campaña', 'creadores', 'jugadores', 'chatsGenerales', 'chatsJugadores'));
}


    private function crearChatsYUnirse($campaña)
{
    // Crear los chats asociados a esta campaña
    $generalChat = Chat::crear('General', $campaña);
    $recursosChat = Chat::crear('Recursos', $campaña);
    $npcChat = Chat::crear('Npc', $campaña);

    $creador = Auth::user();
    $generalChat->unirseAChat($creador, true);
    $recursosChat->unirseAChat($creador, true);
    $npcChat->unirseAChat($creador, true);

}
}
