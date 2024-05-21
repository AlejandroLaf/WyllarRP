<!-- resources/views/personajes/create-step1.blade.php -->
<x-app-layout title="Crear Personaje - Paso 1">
    @section('hero')
        <div class="w-full text-center py-32 flex justify-center flex-col items-center">
            <h1 class="text-2xl md:text-3xl font-bold lg:text-5xl mb-8">Crear Personaje - Paso 1</h1>

            <form action="{{ route('personajes.storeStep1') }}" method="POST" class="w-1/3">
                @csrf
                <div class="mb-4">
                    <input type="text" name="nombre" placeholder="Nombre del personaje" class="w-full px-3 py-2 rounded"
                        required>
                </div>

                <div class="mb-4">
                    <select name="clase_id" class="w-full px-3 py-2 rounded" required>
                        <option value="">Seleccionar clase</option>
                        @foreach ($clases as $clase)
                            <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <input type="number" name="nivel" placeholder="Nivel (1-11)" class="w-full px-3 py-2 rounded"
                        min="1" max="11" required>
                </div>

                <div class="mb-4">
                    <select name="predilecta" class="w-full px-3 py-2 rounded" required>
                        <option value="">Seleccionar estadística predilecta</option>
                        @foreach (['FUE', 'DES', 'CON', 'PER', 'SAB', 'CAR', 'VOL'] as $stat)
                            <option value="{{ $stat }}">{{ $stat }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-3 py-2 text-lg text-white rounded mt-8 inline-block"
                    style="background-color: #22CC7C">Siguiente</button>
            </form>
        </div>
    @endsection
</x-app-layout>
