<x-app-layout title="Personajes">
    @section('hero')
        <div class="w-full text-center py-32 flex justify-center">
            <div style="width:40%; height:200px;background-color:#9823CC;border-radius: 30px"
                class="flex flex-row items-center justify-evenly">
                <div style="width: 90%;height:90%;background-color:#CC9523;border-radius: 30px"
                    class="flex flex-col items-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white"
                        style="margin-top: 40px">
                        CREA UN PERSONAJE
                    </h1>
                    @auth
                        <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C"
                            href="{{ route('personajes.create') }}">
                            Crear
                        </a>
                    @else
                        <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C"
                            href="{{ route('login') }}">
                            Crear
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="w-full text-center flex justify-center flex-row">
            @if (session('success'))
                <div
                    style="width: 40%; height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    style="width: 40%; height: auto; background-color: #FF4444; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px;">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Cajas de Personaje -->
        @auth
            @if ($personajes->count() > 0)
                <div class="w-full flex justify-around ">
                    @foreach ($personajes as $personaje)
                        <div
                            style="width: 30%; height: 200px; background-color: #9823CC; border-radius: 10px; margin: 10px; padding: 10px;">
                            <div class="flex flex-col text-center align-middle"
                                style="width: 95%; height: 90%; background-color: #CC9523; border-radius: 10px; margin: 10px; padding: 10px;">
                                <h2 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white">
                                    {{ $personaje->nombre }}
                                </h2>
                                <a class="px-3 py-2 text-lg text-white rounded mt-2 inline-block"
                                    style="background-color: #22CC7C"
                                    href="{{ route('personajes.show', ['id' => $personaje->id]) }}">
                                    entrar
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full text-center flex justify-center flex-row">
                    <div
                        style="width: 40%; height: auto; background-color: #FF4444; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:100px">
                        <p>No se encontraron personajes para mostrar.</p>
                    </div>
                </div>
            @endif
        @else
            <div class="w-full text-center flex justify-center flex-row">
                <div
                    style="width: 40%; height: auto; background-color: #22CC7C; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:10px">
                    <p>Inicia sesión y crea tus personajes.</p>
                </div>
            </div>
        @endauth
    @endsection
</x-app-layout>
