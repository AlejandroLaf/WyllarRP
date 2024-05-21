<x-app-layout title="Crear Personaje - Paso 2">
    @section('hero')
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-center">Asignación de Estadísticas</h1>

            <div class="text-center mb-4">
                <p>Puntos restantes: <span id="puntosRestantes">{{ $puntosTotales }}</span></p>
            </div>

            <form action="{{ route('personajes.storeStep2') }}" method="POST" class="w-1/3">
                @csrf
                <input type="hidden" id="nivel" value="{{ $personajeData['nivel'] }}">

                @foreach ($stats as $stat => $value)
                    <div class="mb-4">
                        <label for="{{ $stat }}" class="block text-lg font-medium">{{ $stat }}</label>
                        <div class="flex items-center">
                            <button type="button" id="{{ $stat }}_decrement" class="px-3 py-1 bg-red-500 text-white rounded">-</button>
                            <input type="hidden" id="{{ $stat }}" name="{{ $stat }}" value="{{ $value }}">
                            <span id="{{ $stat }}_value" class="ml-4 text-xl">{{ $value }}</span>
                            <button type="button" id="{{ $stat }}_increment" class="px-3 py-1 bg-green-500 text-white rounded">+</button>
                        </div>
                    </div>
                @endforeach

                <div class="mt-6">
                    <h2 class="text-xl font-bold">Estadísticas Calculadas</h2>
                    <p>VIT: <span id="VIT_value"></span></p>
                    <p>HP: <span id="HP_value"></span></p>
                    <p>Defensa: <span id="defensa_value"></span></p>

                    <input type="hidden" name="VIT" id="VIT">
                    <input type="hidden" name="HP" id="HP">
                    <input type="hidden" name="defensa" id="defensa">
                </div>

                @if ($especializaciones)
                    <label for="especializacion" class="block text-lg font-medium">Especialización</label>
                    <select name="especializacion_id" id="especializacion" class="block w-full mt-1">
                        @foreach ($especializaciones as $especializacion)
                            <option value="{{ $especializacion->id }}">{{ $especializacion->nombre }}</option>
                        @endforeach
                    </select>
                @endif

                <div class="mt-8 text-center">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Siguiente</button>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const stats = ['FUE', 'DES', 'CON', 'PER', 'SAB', 'CAR', 'VOL'];
                let puntosRestantes = {{ $puntosTotales }};
                const predilecta = "{{ $personajeData['predilecta'] }}"; // Obtener la estadística predilecta

                function updateStats() {
                    stats.forEach(stat => {
                        const value = parseInt(document.getElementById(stat).value);
                        document.getElementById(`${stat}_value`).innerText = value;
                    });

                    const CON = parseInt(document.getElementById('CON').value);
                    const FUE = parseInt(document.getElementById('FUE').value);
                    const DES = parseInt(document.getElementById('DES').value);
                    let VIT = Math.floor((20 - CON) / 2);
                    const nivel = parseInt(document.getElementById('nivel').value);
                    const calculoSalud = "{{ $clase->calculo_salud }}";
                    const HP = eval(calculoSalud.replace('X', VIT).replace('VIT', VIT).replace('Lvl', nivel));
                    const defensa = Math.floor((20 - FUE + 20 - DES) / 4);

                    document.getElementById('VIT_value').innerText = VIT;
                    document.getElementById('HP_value').innerText = HP;
                    document.getElementById('defensa_value').innerText = defensa;
                    document.getElementById('puntosRestantes').innerText = puntosRestantes;

                    document.getElementById('VIT').value = VIT;
                    document.getElementById('HP').value = HP;
                    document.getElementById('defensa').value = defensa;
                }

                stats.forEach(stat => {
                    document.getElementById(`${stat}_decrement`).addEventListener('click', () => {
                        let statElement = document.getElementById(stat);
                        if (parseInt(statElement.value) > ((stat === predilecta) ? 13 - {{ $personajeData['nivel'] }} : 14 - {{ $personajeData['nivel'] }}) && puntosRestantes > 0) {
                            statElement.value = parseInt(statElement.value) - 1;
                            puntosRestantes--;
                            updateStats();
                        }
                    });

                    document.getElementById(`${stat}_increment`).addEventListener('click', () => {
                        let statElement = document.getElementById(stat);
                        if (parseInt(statElement.value) < ((stat === predilecta) ? 13 : 14)) {
                            statElement.value = parseInt(statElement.value) + 1;
                            puntosRestantes++;
                            updateStats();
                        }
                    });
                });

                updateStats();
            });
        </script>
    @endsection
</x-app-layout>

