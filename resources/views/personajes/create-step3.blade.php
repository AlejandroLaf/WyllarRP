<x-app-layout title="Crear Personaje - Paso 3">
    @section('hero')
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-center">Selección de Habilidades</h1>

            <div class="text-center mb-4">
                <p>Habilidades disponibles: {{ $hbCount }}</p>
                <p>Habilidades seleccionadas: <span id="habilidadesSeleccionadas">0</span></p>
            </div>

            <form action="{{ route('personajes.storeStep3') }}" method="POST">
                @csrf

                <h2 class="text-lg font-bold mb-2">Habilidades de Clase</h2>
                <div>
                    @foreach ($habilidadesClase as $habilidad)
                        <label>
                            <input type="checkbox" name="habilidades_seleccionadas[]" value="{{ $habilidad->id }}"
                                {{ in_array($habilidad->id, $habilidadesSeleccionadas) ? 'checked' : '' }}>
                            {{ $habilidad->nombre }} - {{ $habilidad->descripcion }}
                        </label><br>
                    @endforeach
                </div>

                @if ($especializacion)
                    <h2 class="text-lg font-bold mt-4 mb-2">Habilidades de Especialización</h2>
                    <div>
                        @foreach ($habilidadesEspecializacion as $habilidad)
                            <input type="hidden" name="habilidades_seleccionadas[]" value="{{ $habilidad->id }}">
                            <p>{{ $habilidad->nombre }} - {{ $habilidad->descripcion }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="mt-8 text-center">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Guardar</button>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                const habilidadesSeleccionadas = document.getElementById('habilidadesSeleccionadas');
                let habilidadesSeleccionadasCount = 0;
                const maxHabilidades = {{ $hbCount }};

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            habilidadesSeleccionadasCount++;
                        } else {
                            habilidadesSeleccionadasCount--;
                        }

                        // Limitar el valor mínimo a 0 y el valor máximo a hbCount
                        habilidadesSeleccionadasCount = Math.min(Math.max(habilidadesSeleccionadasCount,
                            0), maxHabilidades);

                        habilidadesSeleccionadas.textContent = habilidadesSeleccionadasCount;

                        if (habilidadesSeleccionadasCount >= maxHabilidades) {
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
