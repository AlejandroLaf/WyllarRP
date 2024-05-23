<x-app-layout title="Personaje">
    @section('hero')
        <div class="container mx-auto mt-6 w-full">


            <div class="w-full text-center flex justify-center flex-row">
                <div
                    style="width: 100%;height: auto; background-color: #9823CC; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->nombre }} Nivel {{ $personaje->nivel }}
                    </p>
                </div>
            </div>

            <div class="w-full text-center flex justify-around flex-row mt-6 mb-8">
                <div
                    style="width: 5%;height: auto; border: 3px solid #9823CC; border-radius: 10px; padding: 10px; color: #CC9523; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->FUE }}</p>
                    <p class="text-2xl font-bold text-center w-full">FUE</p>
                </div>

                <div
                    style="width: 5%;height: auto; border: 3px solid #9823CC; border-radius: 10px; padding: 10px; color: #CC9523; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->DES }}</p>
                    <p class="text-2xl font-bold text-center w-full">DES</p>
                </div>

                <div
                    style="width: 5%;height: auto; border: 3px solid #9823CC; border-radius: 10px; padding: 10px; color: #CC9523; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->CON }}</p>
                    <p class="text-2xl font-bold text-center w-full">CON</p>
                </div>

                <div
                    style="width: 5%;height: auto; border: 3px solid #9823CC; border-radius: 10px; padding: 10px; color: #CC9523; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->SAB }}</p>
                    <p class="text-2xl font-bold text-center w-full">SAB</p>
                </div>

                <div
                    style="width: 5%;height: auto; border: 3px solid #9823CC; border-radius: 10px; padding: 10px; color: #CC9523; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->CAR }}</p>
                    <p class="text-2xl font-bold text-center w-full">CAR</p>
                </div>

                <div
                    style="width: 5%;height: auto; border: 3px solid #9823CC; border-radius: 10px; padding: 10px; color: #CC9523; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->VOL }}</p>
                    <p class="text-2xl font-bold text-center w-full">VOL</p>
                </div>
            </div>

            <div class="w-full text-center flex justify-around flex-row mt-6">
                <div
                    style="width: 15%;height: auto; border: 3px solid #CC9523; background-color: #CC9523; border-radius: 10px; padding: 10px; color: white; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->HP }}/{{ $personaje->HP }}</p>
                    <p class="text-2xl font-bold text-center w-full">HP</p>
                </div>

                <div
                    style="width: 15%;height: auto; border: 3px solid #CC9523; background-color: #CC9523; border-radius: 10px; padding: 10px; color: white; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">{{ $personaje->PH }}/{{ $personaje->PH }}</p>
                    <p class="text-2xl font-bold text-center w-full">PH</p>
                </div>

                <div
                    style="width: 60%;height: auto; border: 3px solid #CC9523; background-color: #CC9523; border-radius: 10px; padding: 10px; color: white; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">Defensa: {{ $personaje->defensa }} - Armadura:
                        {{ $personaje->armadura }} - Armadura Mágica: {{ $personaje->armadura_magica }}</p>
                </div>
            </div>

            <div class="w-full text-center flex justify-center flex-row">
                <div
                    style="width: 100%;height: auto; background-color: #9823CC; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">RASGOS</p>
                </div>
            </div>

            <div class="w-full   flex justify-center flex-row">
                <div
                    style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                    @foreach ($rasgos as $rasgo)
                        <p class="text-xl font-bold w-full mx-7 my-7">{{ $rasgo->nombre }}: {{ $rasgo->descripcion }}</p>
                    @endforeach
                </div>
            </div>

            <div class="w-full text-center flex justify-center flex-row">
                <div
                    style="width: 100%;height: auto; background-color: #9823CC; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                    <p class="text-2xl font-bold text-center w-full">HABILIDADES</p>
                </div>
            </div>

            <div class="w-full   flex justify-center flex-row">
                <div
                    style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                    @foreach ($habilidades as $habilidad)
                        <p class="text-xl font-bold w-full mx-7 my-7">{{ $habilidad->nombre }}:
                            {{ $habilidad->descripcion }}</p>
                    @endforeach
                </div>
            </div>

            @if ($ranuras)
                <div class="w-full text-center flex justify-center flex-row">
                    <div
                        style="width: 100%;height: auto; background-color: #9823CC; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                        <p class="text-2xl font-bold text-center w-full">MAGIA</p>
                    </div>
                </div>

                @if ($ranuras->ranuraMax1 > 0)
                    <div class="w-full text-center flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                            <p class="text-2xl font-bold text-center w-full">NIVEL 1: {{$ranuras->ranuraMax1}}/{{$ranuras->ranuraActual1}}</p>
                        </div>
                    </div>

                    <div class="w-full   flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                            @foreach ($hechizosPorNivel['nivel1'] as $hechizo)
                                <p class="text-xl font-bold w-full mx-7 my-7">{{ $hechizo->nombre }}: {{ $hechizo->descripcion }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($ranuras->ranuraMax2 > 0)
                    <div class="w-full text-center flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                            <p class="text-2xl font-bold text-center w-full">NIVEL 2: {{$ranuras->ranuraMax2}}/{{$ranuras->ranuraActual2}}</p>
                        </div>
                    </div>

                    <div class="w-full   flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                            @foreach ($hechizosPorNivel['nivel2'] as $hechizo)
                                <p class="text-xl font-bold w-full mx-7 my-7">{{ $hechizo->nombre }}: {{ $hechizo->descripcion }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($ranuras->ranuraMax3 > 0)
                    <div class="w-full text-center flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                            <p class="text-2xl font-bold text-center w-full">NIVEL 3: {{$ranuras->ranuraMax3}}/{{$ranuras->ranuraActual3}}</p>
                        </div>
                    </div>

                    <div class="w-full   flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                            @foreach ($hechizosPorNivel['nivel3'] as $hechizo)
                                <p class="text-xl font-bold w-full mx-7 my-7">{{ $hechizo->nombre }}: {{ $hechizo->descripcion }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($ranuras->ranuraMax4 > 0)
                    <div class="w-full text-center flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                            <p class="text-2xl font-bold text-center w-full">NIVEL 4: {{$ranuras->ranuraMax4}}/{{$ranuras->ranuraActual4}}</p>
                        </div>
                    </div>

                    <div class="w-full   flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                            @foreach ($hechizosPorNivel['nivel4'] as $hechizo)
                                <p class="text-xl font-bold w-full mx-7 my-7">{{ $hechizo->nombre }}: {{ $hechizo->descripcion }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($ranuras->ranuraMax5 > 0)
                    <div class="w-full text-center flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                            <p class="text-2xl font-bold text-center w-full">NIVEL 5: {{$ranuras->ranuraMax5}}/{{$ranuras->ranuraActual5}}</p>
                        </div>
                    </div>

                    <div class="w-full   flex justify-center flex-row">
                        <div
                            style="width: 100%;height: auto;border: 3px solid #CC9523; border-radius: 10px; padding: 10px; color: #9823CC; margin-top: 10px; margin-bottom:10px">
                            @foreach ($hechizosPorNivel['nivel5'] as $hechizo)
                                <p class="text-xl font-bold w-full mx-7 my-7">{{ $hechizo->nombre }}: {{ $hechizo->descripcion }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            {{-- <div class="mb-6">
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

            <div class="mb-4">
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
            </div> --}}
        </div>
    @endsection
</x-app-layout>
