<x-app-layout title="Crear Personaje - Paso de Magia">
    @section('hero')
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-center">Selección de Hechizos</h1>

            <div class="text-center mb-4">
                <p>Ranuras de magia disponibles:</p>
                <ul>
                    <li>Nivel 1: {{ $magiaClase->ranuras1 }}</li>
                    <li>Nivel 2: {{ $magiaClase->ranuras2 }}</li>
                    <li>Nivel 3: {{ $magiaClase->ranuras3 }}</li>
                    <li>Nivel 4: {{ $magiaClase->ranuras4 }}</li>
                    <li>Nivel 5: {{ $magiaClase->ranuras5 }}</li>
                </ul>
                <input type="hidden" name="ranuras1" value="{{ $magiaClase->ranuras1 }}">
                <input type="hidden" name="ranuras2" value="{{ $magiaClase->ranuras2 }}">
                <input type="hidden" name="ranuras3" value="{{ $magiaClase->ranuras3 }}">
                <input type="hidden" name="ranuras4" value="{{ $magiaClase->ranuras4 }}">
                <input type="hidden" name="ranuras5" value="{{ $magiaClase->ranuras5 }}">
            </div>

            <form action="{{ route('personajes.storeStepMagia') }}" method="POST">
                @csrf

                @if ($magiaClase->hechizos1 > 0)
                    <h1 class="text-xl font-bold text-center">Hechizos de Nivel 1 ({{ $magiaClase->hechizos1 }} disponibles)</h1>
                    <div>
                        @foreach ($hechizos1 as $hechizo)
                            <label>
                                <input type="checkbox" name="hechizos_seleccionados1[]" class="hechizo-nivel-1" value="{{ $hechizo->id }}">
                                {{ $hechizo->nombre }} - {{ $hechizo->descripcion }}
                            </label><br>
                        @endforeach
                    </div>
                @endif

                @if ($magiaClase->hechizos2 > 0)
                <h1 class="text-xl font-bold text-center">Hechizos de Nivel 2 ({{ $magiaClase->hechizos2 }} disponibles)</h1>
                    <div>
                        @foreach ($hechizos2 as $hechizo)
                            <label>
                                <input type="checkbox" name="hechizos_seleccionados2[]" class="hechizo-nivel-2" value="{{ $hechizo->id }}">
                                {{ $hechizo->nombre }} - {{ $hechizo->descripcion }}
                            </label><br>
                        @endforeach
                    </div>
                @endif

                @if ($magiaClase->hechizos3 > 0)
                    <h1 class="text-xl font-bold text-center">>Hechizos de Nivel 3 ({{ $magiaClase->hechizos3 }} disponibles)</h1>
                    <div>
                        @foreach ($hechizos3 as $hechizo)
                            <label>
                                <input type="checkbox" name="hechizos_seleccionados3[]" class="hechizo-nivel-3" value="{{ $hechizo->id }}">
                                {{ $hechizo->nombre }} - {{ $hechizo->descripcion }}
                            </label><br>
                        @endforeach
                    </div>
                @endif

                @if ($magiaClase->hechizos4 > 0)
                <h1 class="text-xl font-bold text-center">Hechizos de Nivel 4 ({{ $magiaClase->hechizos4 }} disponibles)</h1>
                    <div>
                        @foreach ($hechizos4 as $hechizo)
                            <label>
                                <input type="checkbox" name="hechizos_seleccionados4[]" class="hechizo-nivel-4" value="{{ $hechizo->id }}">
                                {{ $hechizo->nombre }} - {{ $hechizo->descripcion }}
                            </label><br>
                        @endforeach
                    </div>
                @endif

                @if ($magiaClase->hechizos5 > 0)
                <h1 class="text-xl font-bold text-center">Hechizos de Nivel 5 ({{ $magiaClase->hechizos5 }} disponibles)</h1>
                    <div>
                        @foreach ($hechizos5 as $hechizo)
                            <label>
                                <input type="checkbox" name="hechizos_seleccionados5[]" class="hechizo-nivel-5" value="{{ $hechizo->id }}">
                                {{ $hechizo->nombre }} - {{ $hechizo->descripcion }}
                            </label><br>
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
                function manageCheckboxes(level, maxAllowed) {
                    const checkboxes = document.querySelectorAll(`.hechizo-nivel-${level}`);
                    let checkedCount = 0;

                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            checkedCount++;
                        }
                    });

                    checkboxes.forEach(checkbox => {
                        if (!checkbox.checked) {
                            checkbox.disabled = checkedCount >= maxAllowed;
                        }
                    });
                }

                const ranuras = {
                    1: {{ $magiaClase->ranuras1 }},
                    2: {{ $magiaClase->ranuras2 }},
                    3: {{ $magiaClase->ranuras3 }},
                    4: {{ $magiaClase->ranuras4 }},
                    5: {{ $magiaClase->ranuras5 }}
                };

                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        for (let level = 1; level <= 5; level++) {
                            manageCheckboxes(level, ranuras[level]);
                        }
                    });
                });

                // Inicializa los contadores al cargar la página
                for (let level = 1; level <= 5; level++) {
                    manageCheckboxes(level, ranuras[level]);
                }
            });
        </script>
    @endsection
</x-app-layout>
