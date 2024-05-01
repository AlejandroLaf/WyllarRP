<?php

namespace App\Http\Controllers;

use App\Models\Campaña;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CampañaController extends Controller
{
    public function index()
    {

        $usuario = Auth::user();
        $campañas = Campaña::whereHas('creadores', function ($query) use ($usuario) {
            $query->where('users.id', $usuario->id);
        })->orWhereHas('jugadores', function ($query) use ($usuario) {
            $query->where('users.id', $usuario->id);
        })->paginate(3);


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

        return redirect()->back()->with('success', 'Te has unido a la campaña exitosamente.');
    }

    public function show($id)
{
    $campaña = Campaña::findOrFail($id);

    $jugadores = User::whereIn('id', $campaña->jugadores()->pluck('user_id'))->get();

    $creadores = User::whereIn('id', $campaña->creadores()->pluck('user_id'))->get();

    return view('campañas.show', compact('campaña', 'creadores', 'jugadores'));

}




    // public function show(Post $post)
    // {
    //     return view('posts.show', [
    //         'post' => $post,
    //     ]);
    // }
}
