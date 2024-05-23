<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Especializacion;
use App\Models\Habilidad;
use App\Models\Hechizo;
use App\Models\Personaje;
use App\Models\Rasgo;
use App\Models\TablaClase;
use App\Models\TablaMagiaClase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonajesController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $personajes = Personaje::where('user_id', $user->id)->paginate(6);
            return view('personajes.index', compact('personajes'));
        } else {
            $personajes = Personaje::paginate(0);
            return view('personajes.index', compact('personajes'));
        }
    }

    public function show($id)
{
    $personaje = Personaje::findOrFail($id);

    $rasgos = $personaje->rasgos;

    $habilidades = $personaje->habilidades;

    $ranuras = $personaje->ranurasPersonaje;

    $hechizos = $personaje->hechizos;
    $hechizosPorNivel = [
        'nivel1' => [],
        'nivel2' => [],
        'nivel3' => [],
        'nivel4' => [],
        'nivel5' => []
    ];

    foreach ($hechizos as $hechizo) {
        switch ($hechizo->pivot->nivel) {
            case 1:
                $hechizosPorNivel['nivel1'][] = $hechizo;
                break;
            case 2:
                $hechizosPorNivel['nivel2'][] = $hechizo;
                break;
            case 3:
                $hechizosPorNivel['nivel3'][] = $hechizo;
                break;
            case 4:
                $hechizosPorNivel['nivel4'][] = $hechizo;
                break;
            case 5:
                $hechizosPorNivel['nivel5'][] = $hechizo;
                break;
        }
    }

    return view('personajes.show', compact('personaje', 'rasgos', 'habilidades', 'ranuras', 'hechizosPorNivel'));
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

        $phNivel = TablaClase::where('clase_id', $clase->id)
            ->where('nivel', $personajeData['nivel'])
            ->value('PH');

        $especializaciones = null;
        if ($personajeData['nivel'] >= 3) {
            $especializaciones = Especializacion::where('clase_id', $clase->id)->get();
        }

        return view('personajes.create-step2', compact('personajeData', 'stats', 'puntosTotales', 'phNivel', 'especializaciones', 'clase'));
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
        $PH = $request->input('PH');
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
            'PH' => $PH,
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

    public function createStep4(Request $request)
    {
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        $clase = Clase::findOrFail($personajeData['clase_id']);
        $nivel = $personajeData['nivel'];
        $tablaClase = TablaClase::where('clase_id', $clase->id)->where('nivel', '<=', $nivel)->pluck('rasgos')->toArray();

        // Contar cuántas veces aparece "RB" en los rasgos
        $rbCount = 0;
        foreach ($tablaClase as $rasgos) {
            $rbCount += substr_count($rasgos, 'RB');
        }

        $rasgosClase = $clase->rasgos;
        $rasgosDisponibles = $rasgosClase;

        $especializacion = null;
        $rasgosEspecializacion = collect();
        if (isset($personajeData['especializacion_id'])) {
            $especializacion = Especializacion::findOrFail($personajeData['especializacion_id']);
            $rasgosEspecializacion = $especializacion->rasgos()->where('nivel', '<=', $nivel)->get();
            $rasgosDisponibles = $rasgosDisponibles->merge($rasgosEspecializacion);
        }

        return view('personajes.create-step4', compact('personajeData', 'rbCount', 'rasgosDisponibles', 'rasgosClase', 'especializacion', 'rasgosEspecializacion'));
    }

    public function storeStep4(Request $request)
    {
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        $rasgosSeleccionados = $request->input('rasgos_seleccionados', []);

        // Añadir los rasgos seleccionados al personaje
        $personajeData['rasgos'] = $rasgosSeleccionados;
        session(['personaje_data' => $personajeData]);

        // Comprobar si la clase tiene magia
        $clase = Clase::findOrFail($personajeData['clase_id']);
        $nivel = $personajeData['nivel'];
        $magiaClase = TablaMagiaClase::where('clase_id', $clase->id)->where('nivel', '<=', $nivel)->first();

        if ($magiaClase) {
            // Redirigir al paso de selección de magia si la clase tiene magia
            return redirect()->route('personajes.createStepMagia');
        } else {
            // Redirigir al paso final si la clase no tiene magia
            return redirect()->route('personajes.createStepFinal');
        }
    }

    public function createStepMagia(Request $request)
    {
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        $clase = Clase::findOrFail($personajeData['clase_id']);
        $nivel = $personajeData['nivel'];
        $magiaClase = TablaMagiaClase::where('clase_id', $clase->id)->where('nivel', $nivel)->first();

        $hechizos1 = [];
        $hechizos2 = [];
        $hechizos3 = [];
        $hechizos4 = [];
        $hechizos5 = [];

        // Obtener los hechizos de la clase para cada nivel
        foreach (range(1, 5) as $nivelHechizo) {
            $hechizosClaseNivel = Hechizo::join('hechizos_clase', 'hechizos.id', '=', 'hechizos_clase.hechizo_id')
                ->where('hechizos_clase.clase_id', $clase->id)
                ->where('hechizos_clase.nivel', $nivelHechizo)
                ->get(['hechizos.*', 'hechizos_clase.nivel as nivel_hechizo']);

            foreach ($hechizosClaseNivel as $hechizo) {
                ${"hechizos" . $nivelHechizo}[] = $hechizo;
            }
        }

        // Obtener los hechizos de la especialización si existe
        if (isset($personajeData['especializacion_id'])) {
            $especializacion = Especializacion::findOrFail($personajeData['especializacion_id']);

            foreach (range(1, 5) as $nivelHechizo) {
                $hechizosEspecializacionNivel = Hechizo::join('hechizos_especializacion', 'hechizos.id', '=', 'hechizos_especializacion.hechizo_id')
                    ->where('hechizos_especializacion.especializacion_id', $especializacion->id)
                    ->where('hechizos_especializacion.nivel', $nivelHechizo)
                    ->get(['hechizos.*', 'hechizos_especializacion.nivel as nivel_hechizo']);

                foreach ($hechizosEspecializacionNivel as $hechizo) {
                    ${"hechizos" . $nivelHechizo}[] = $hechizo;
                }
            }
        }

        return view('personajes.create-step-magia', compact('personajeData', 'magiaClase', 'hechizos1', 'hechizos2', 'hechizos3', 'hechizos4', 'hechizos5'));
    }


    public function storeStepMagia(Request $request)
    {
        // Recuperar los datos del personaje desde la sesión
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        $clase = Clase::findOrFail($personajeData['clase_id']);
        $nivel = $personajeData['nivel'];
        $magiaClase = TablaMagiaClase::where('clase_id', $clase->id)->where('nivel', $nivel)->first();

        // Guardar las ranuras de magia en la sesión
        $personajeData['ranuras_magia1'] = $magiaClase->ranuras1;
        $personajeData['ranuras_magia2'] = $magiaClase->ranuras2;
        $personajeData['ranuras_magia3'] = $magiaClase->ranuras3;
        $personajeData['ranuras_magia4'] = $magiaClase->ranuras4;
        $personajeData['ranuras_magia5'] = $magiaClase->ranuras5;

        // Guardar los hechizos seleccionados en la sesión
        $personajeData['hechizos_seleccionados1'] = $request->hechizos_seleccionados1 ?? [];
        $personajeData['hechizos_seleccionados2'] = $request->hechizos_seleccionados2 ?? [];
        $personajeData['hechizos_seleccionados3'] = $request->hechizos_seleccionados3 ?? [];
        $personajeData['hechizos_seleccionados4'] = $request->hechizos_seleccionados4 ?? [];
        $personajeData['hechizos_seleccionados5'] = $request->hechizos_seleccionados5 ?? [];

        // Actualizar la sesión con los nuevos datos
        session(['personaje_data' => $personajeData]);

        // Redirigir a la vista final del personaje
        return redirect()->route('personajes.createFinal');
    }

    public function createFinal()
    {
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        // Recuperar las entidades relacionadas
        $clase = Clase::find($personajeData['clase_id']);
        $especializacion = isset($personajeData['especializacion_id']) ? Especializacion::find($personajeData['especializacion_id']) : null;

        // Recuperar los detalles de las estadísticas
        $stats = $personajeData['stats'];

        $habilidades = Habilidad::whereIn('id', $personajeData['habilidades'])->get();
        $rasgos = Rasgo::whereIn('id', $personajeData['rasgos'])->get();
        $hechizosSeleccionados1 = Hechizo::whereIn('id', $personajeData['hechizos_seleccionados1'] ?? [])->get();
        $hechizosSeleccionados2 = Hechizo::whereIn('id', $personajeData['hechizos_seleccionados2'] ?? [])->get();
        $hechizosSeleccionados3 = Hechizo::whereIn('id', $personajeData['hechizos_seleccionados3'] ?? [])->get();
        $hechizosSeleccionados4 = Hechizo::whereIn('id', $personajeData['hechizos_seleccionados4'] ?? [])->get();
        $hechizosSeleccionados5 = Hechizo::whereIn('id', $personajeData['hechizos_seleccionados5'] ?? [])->get();


        return view('personajes.final', compact('personajeData', 'clase', 'especializacion', 'stats', 'habilidades', 'rasgos', 'hechizosSeleccionados1', 'hechizosSeleccionados2', 'hechizosSeleccionados3', 'hechizosSeleccionados4', 'hechizosSeleccionados5'));
    }

    public function storeFinal(Request $request)
    {
        $personajeData = session('personaje_data');
        if (!$personajeData) {
            return redirect()->route('personajes.createStep1');
        }

        // Crear el personaje
        $personaje = Personaje::create([
            'nombre' => $personajeData['nombre'],
            'FUE' => $personajeData['stats']['FUE'],
            'DES' => $personajeData['stats']['DES'],
            'CON' => $personajeData['stats']['CON'],
            'PER' => $personajeData['stats']['PER'],
            'SAB' => $personajeData['stats']['SAB'],
            'CAR' => $personajeData['stats']['CAR'],
            'VOL' => $personajeData['stats']['VOL'],
            'VIT' => $personajeData['VIT'],
            'PH' => $personajeData['PH'],
            'HP' => $personajeData['HP'],
            'nivel' => $personajeData['nivel'],
            'defensa' => $personajeData['defensa'],
            // Otras columnas necesarias
            'user_id' => auth()->id(), // Opcional: Asignar el ID del usuario autenticado
            'clase_id' => $personajeData['clase_id'],
            'especializacion_id' => isset($personajeData['especializacion_id']) ? $personajeData['especializacion_id'] : null,
        ]);

        // Guardar las ranuras de magia
        $ranuras = [
            'ranuraMax1' => $personajeData['ranuras_magia1'],
            'ranuraMax2' => $personajeData['ranuras_magia2'],
            'ranuraMax3' => $personajeData['ranuras_magia3'],
            'ranuraMax4' => $personajeData['ranuras_magia4'],
            'ranuraMax5' => $personajeData['ranuras_magia5'],
            'ranuraActual1' => $personajeData['ranuras_magia1'],
            'ranuraActual2' => $personajeData['ranuras_magia2'],
            'ranuraActual3' => $personajeData['ranuras_magia3'],
            'ranuraActual4' => $personajeData['ranuras_magia4'],
            'ranuraActual5' => $personajeData['ranuras_magia5'],
        ];

        $personaje->ranurasPersonaje()->create($ranuras);

        // Guardar las habilidades
        if (isset($personajeData['habilidades'])) {
            $personaje->habilidades()->attach($personajeData['habilidades']);
        }

        // Guardar los rasgos
        if (isset($personajeData['rasgos'])) {
            $personaje->rasgos()->attach($personajeData['rasgos']);
        }

        for ($i = 1; $i <= 5; $i++) {
            $nivelHechizosSeleccionados = 'hechizos_seleccionados' . $i;

            // Verifica si existe la variable para el nivel actual
            if (isset($personajeData[$nivelHechizosSeleccionados])) {
                // Obtiene los IDs de los hechizos seleccionados para este nivel
                $hechizosSeleccionados = $personajeData[$nivelHechizosSeleccionados];

                // Itera sobre cada hechizo seleccionado y los guarda en el personaje
                foreach ($hechizosSeleccionados as $hechizoId) {
                    $hechizo = Hechizo::find($hechizoId);
                    if ($hechizo) {
                        $personaje->hechizos()->attach($hechizoId, ['nivel' => $i]);
                    }
                }
            }
        }

        // Limpiar la sesión
        session()->forget('personaje_data');

        // Redirigir al paso final del personaje
        return redirect()->route('personajes.index')->with('success', 'Personaje creado con éxito.');
    }
}
