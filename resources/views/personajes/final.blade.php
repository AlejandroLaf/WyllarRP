<x-app-layout title="Resumen del Personaje">
    @section('hero')
        <div class="container mx-auto mt-6">
            <h1 class="text-2xl font-bold text-center">Resumen del Personaje</h1>

            <div class="text-center mb-4 mt-6">
                <h2 class="text-xl font-bold">Nombre: {{ $personajeData['nombre'] }}</h2>
                <p class="text-xl font-bold">Clase: {{ $clase->nombre }}</p>
                <p class="text-xl font-bold">Nivel: {{ $personajeData['nivel'] }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-bold text-center">Estadísticas:</h3>
                <ul class="text-xl font-bold text-center">
                    <li>FUE: {{ $personajeData['stats']['FUE'] }}</li>
                    <li>DES: {{ $personajeData['stats']['DES'] }}</li>
                    <li>CON: {{ $personajeData['stats']['CON'] }}</li>
                    <li>PER: {{ $personajeData['stats']['PER'] }}</li>
                    <li>SAB: {{ $personajeData['stats']['SAB'] }}</li>
                    <li>CAR: {{ $personajeData['stats']['CAR'] }}</li>
                    <li>VOL: {{ $personajeData['stats']['VOL'] }}</li> <br>
                    <li>HP: {{ $personajeData['HP'] }}</li>
                    <li>VIT: {{ $personajeData['VIT'] }}</li>
                    <li>PH: {{ $personajeData['PH'] }}</li>
                    <li>Defensa: {{ $personajeData['defensa'] }}</li>
                </ul>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-bold text-center">Habilidades:</h3>
                <ul>
                    @foreach ($habilidades as $habilidad)
                        <li>{{ $habilidad->nombre }} - {{ $habilidad->descripcion }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4" >
                <h3 class="text-xl font-bold text-center">Rasgos:</h3>
                <ul>
                    @foreach ($rasgos as $rasgo)
                        <li>{{ $rasgo->nombre }} - {{ $rasgo->descripcion }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-bold text-center">Hechizos:</h3>
                @if ($hechizosSeleccionados1->isNotEmpty())
                    <h4 class="text-lg font-bold text-center">Nivel 1:</h4>
                    <ul>
                        @foreach ($hechizosSeleccionados1 as $hechizo)
                            <li>{{ $hechizo->nombre }} - {{ $hechizo->descripcion }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($hechizosSeleccionados2->isNotEmpty())
                    <h4 class="text-lg font-bold text-center">Nivel 2:</h4>
                    <ul>
                        @foreach ($hechizosSeleccionados2 as $hechizo)
                            <li>{{ $hechizo->nombre }} - {{ $hechizo->descripcion }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($hechizosSeleccionados3->isNotEmpty())
                    <h4 class="text-lg font-bold text-center">Nivel 3:</h4>
                    <ul>
                        @foreach ($hechizosSeleccionados3 as $hechizo)
                            <li>{{ $hechizo->nombre }} - {{ $hechizo->descripcion }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($hechizosSeleccionados4->isNotEmpty())
                    <h4 class="text-lg font-bold text-center">Nivel 4:</h4>
                    <ul>
                        @foreach ($hechizosSeleccionados4 as $hechizo)
                            <li>{{ $hechizo->nombre }} - {{ $hechizo->descripcion }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($hechizosSeleccionados5->isNotEmpty())
                    <h4 class="text-lg font-bold text-center">Nivel 5:</h4>
                    <ul>
                        @foreach ($hechizosSeleccionados5 as $hechizo)
                            <li>{{ $hechizo->nombre }} - {{ $hechizo->descripcion }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>


            <div class="mt-8 text-center">
                <form action="{{ route('personajes.storeFinal') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Guardar Personaje</button>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>
