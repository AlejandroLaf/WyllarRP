<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Especializacion;
use App\Models\Personaje;
use App\Models\TablaClase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonajesController extends Controller
{
    public function index()
    {

        return view('personajes.index');
    }

    public function createStep1()
    {
        $clases = Clase::all();
        return view('personajes.create-step1', compact('clases'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'clase_id' => 'required|exists:clases,id',
            'nivel' => 'required|integer|min:1|max:11',
            'predilecta' => 'required|string|in:FUE,DES,CON,PER,SAB,CAR,VOL', // Validar predilecta
        ]);

        $clase = Clase::findOrFail($request->clase_id);

        $personajeData = [
            'nombre' => $request->nombre,
            'nivel' => $request->nivel,
            'clase_id' => $request->clase_id,
            'user_id' => auth()->id(),
            'stats' => [
                'FUE' => 14,
                'DES' => 14,
                'CON' => 14,
                'PER' => 14,
                'SAB' => 14,
                'CAR' => 14,
                'VOL' => 14,
            ],
            'predilecta' => $request->predilecta,
        ];

        // Decrementar la estadística predilecta
        $personajeData['stats'][$request->predilecta]--;

        // Pasar los datos del personaje a la sesión
        session(['personaje_data' => $personajeData]);

        return redirect()->route('personajes.createStep2');
    }



    public function createStep2(Request $request)
    {
        $personajeData = session('personaje_data');
        $stats = $personajeData['stats'];
        $predilecta = $personajeData['predilecta'];
        $clase = Clase::findOrFail($personajeData['clase_id']);

        // Calcular los puntos de estadísticas disponibles basados en el nivel
        $puntosTotales = TablaClase::where('clase_id', $clase->id)
            ->whereBetween('nivel', [1, $personajeData['nivel']])
            ->sum('stats');

        $especializaciones = null;
        if ($personajeData['nivel'] >= 3) {
            $especializaciones = Especializacion::where('clase_id', $clase->id)->get();
        }

        return view('personajes.create-step2', compact('personajeData', 'stats', 'puntosTotales', 'especializaciones', 'clase'));
    }


    public function storeStep2(Request $request)
    {
        // Obtener los datos existentes en la sesión
        $existingData = session('personaje_data', []);

        // Obtener los datos del formulario
        $nombre = $request->input('nombre');
        $nivel = $request->input('nivel');
        $clase_id = $request->input('clase_id');
        $especializacion_id = $request->input('especializacion_id');
        $VIT = $request->input('VIT');
        $HP = $request->input('HP');
        $defensa = $request->input('defensa');

        // Establecer las estadísticas base con los valores del formulario
        $stats = [
            'FUE' => $request->input('FUE'),
            'DES' => $request->input('DES'),
            'CON' => $request->input('CON'),
            'PER' => $request->input('PER'),
            'SAB' => $request->input('SAB'),
            'CAR' => $request->input('CAR'),
            'VOL' => $request->input('VOL'),
        ];

        // Fusionar los datos existentes con los nuevos datos del formulario
        $personajeData = array_merge($existingData, [
            'especializacion_id' => $especializacion_id,
            'stats' => $stats,
            'VIT' => $VIT,
            'HP' => $HP,
            'defensa' => $defensa,
            'user_id' => auth()->id(),
        ]);

        // Guardar los datos fusionados en la sesión
        session(['personaje_data' => $personajeData]);

        // Redireccionar al siguiente paso
        return redirect()->route('personajes.createStep3');
    }

    public function createStep3(Request $request)
    {
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        $clase = Clase::findOrFail($personajeData['clase_id']);
        $nivel = $personajeData['nivel'];

        // Obtener la tabla de clase y contar las habilidades de clase
        $tablaClase = TablaClase::where('clase_id', $clase->id)->where('nivel', '<=', $nivel)->get();
        $hbCount = $tablaClase->sum(function ($row) {
            return substr_count($row->rasgos, 'HB');
        });

        // Obtener las habilidades de clase
        $habilidadesClase = $clase->habilidades;

        // Si hay una especialización, añadir sus habilidades a las disponibles
        $habilidadesDisponibles = $habilidadesClase;
        if (isset($personajeData['especializacion_id'])) {
            $especializacion = Especializacion::findOrFail($personajeData['especializacion_id']);
            $habilidadesEspecializacion = $especializacion->habilidades;
            $habilidadesDisponibles = $habilidadesDisponibles->merge($habilidadesEspecializacion);
        }

        // Obtener las habilidades seleccionadas del formulario si existen
        $habilidadesSeleccionadas = $request->input('habilidades_seleccionadas', []);

        return view('personajes.create-step3', compact(
            'personajeData',
            'hbCount',
            'habilidadesDisponibles',
            'habilidadesSeleccionadas',
            'habilidadesClase',
            'habilidadesEspecializacion',
            'especializacion'
        ));
    }



    public function storeStep3(Request $request)
{
    // Obtener los datos del personaje desde la sesión
    $personajeData = session('personaje_data');
    if (!$personajeData) {
        return redirect()->route('personajes.createStep1');
    }

    // Validar las habilidades seleccionadas
    $habilidadesSeleccionadas = $request->input('habilidades_seleccionadas', []);

    // Guardar las habilidades seleccionadas en los datos del personaje
    $personajeData['habilidades'] = $habilidadesSeleccionadas;
    session(['personaje_data' => $personajeData]);

    // Redireccionar al siguiente paso
    return redirect()->route('personajes.createStep4');
}

}
