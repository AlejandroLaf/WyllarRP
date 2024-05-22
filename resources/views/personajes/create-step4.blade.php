<x-app-layout title="Crear Personaje - Paso 4">
    @section('hero')
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-center">Selección de Rasgos</h1>

            <div class="text-center mb-4">
                <p>Rasgos disponibles: {{ $rbCount }}</p>
                <p>Rasgos seleccionados: <span id="rasgosSeleccionados">0</span></p>
            </div>

            <form action="{{ route('personajes.storeStep4') }}" method="POST">
                @csrf

                <h2 class="text-lg font-bold mb-2">Rasgos de Clase</h2>
                <div>
                    @foreach ($rasgosClase as $rasgo)
                        <label>
                            <input type="checkbox" name="rasgos_seleccionados[]" value="{{ $rasgo->id }}"
                                {{ in_array($rasgo->id, old('rasgos_seleccionados', [])) ? 'checked' : '' }}>
                            {{ $rasgo->nombre }} - {{ $rasgo->descripcion }}
                        </label><br>
                    @endforeach
                </div>

                @if ($especializacion)
                    <h2 class="text-lg font-bold mt-4 mb-2">Rasgos de Especialización</h2>
                    <div>
                        @foreach ($rasgosEspecializacion as $rasgo)

                                <input type="hidden" name="rasgos_seleccionados[]" value="{{ $rasgo->id }}">
                                <p>{{ $rasgo->nombre }} - {{ $rasgo->descripcion }}</p>
                        @endforeach
                    @endif
                </div>

                <div class="mt-8 text-center">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Guardar</button>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                const rasgosSeleccionados = document.getElementById('rasgosSeleccionados');
                let rasgosSeleccionadosCount = 0;
                const maxRasgos = {{ $rbCount }};

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        if (this.checked) {
                            rasgosSeleccionadosCount++;
                        } else {
                            rasgosSeleccionadosCount--;
                        }

                        // Limitar el valor mínimo a 0 y el valor máximo a rbCount
                        rasgosSeleccionadosCount = Math.min(Math.max(rasgosSeleccionadosCount, 0), maxRasgos);

                        rasgosSeleccionados.textContent = rasgosSeleccionadosCount;

                        if (rasgosSeleccionadosCount >= maxRasgos) {
                            checkboxes.forEach(cb => {
                                if (!cb.checked) {
                                    cb.disabled = true;
                                }
                            });
                        } else {
                            checkboxes.forEach(cb => {
                                cb.disabled = false;
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
