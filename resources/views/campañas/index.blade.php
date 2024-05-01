<x-app-layout title="Home Page">
    @section('hero')
        <div class="w-full text-center py-32 flex justify-around flex-row">
            <div style="width:40%; height:400px;background-color:#9823CC;border-radius: 30px"
                class="flex flex-row items-center justify-evenly">
                <div style="width: 90%;height:90%;background-color:#CC9523;border-radius: 30px"
                    class="flex flex-col items-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white"
                        style="margin-top: 120px">
                        CREA TU CAMPAÑA
                    </h1>
                    @auth
                        <form action="{{ route('campañas.store') }}" method="POST">
                            @csrf
                            <input type="text" name="nombre" placeholder="Nombre de la campaña"
                                class="px-3 py-2 text-lg rounded mt-2 w-72" required>
                            <button type="submit" class="px-3 py-2 text-lg text-white rounded mt-8 inline-block w-52"
                                style="background-color: #22CC7C">Crear</button>
                        </form>
                    @else
                        <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C"
                            href="{{ route('login') }}">
                            Crear
                        </a>
                    @endauth

                </div>
            </div>

            <div style="width:40%; height:400px;background-color:#9823CC;border-radius: 30px"
                class="flex flex-row items-center justify-evenly">
                <div style="width: 90%;height:90%;background-color:#CC9523;border-radius: 30px">
                    <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white"
                        style="margin-top: 120px">
                        UNETE A UNA CAMPAÑA
                    </h1>
                    @auth
                        <form action="{{ route('campañas.unirse') }}" method="POST" class="mt-8">
                            @csrf
                            <input type="text" name="codigo_campaña" placeholder="Código de la campaña"
                                class="px-3 py-2 text-lg rounded mt-2 w-72" required>
                            <button type="submit" class="px-3 py-2 text-lg text-white rounded mt-8 inline-block w-52"
                                style="background-color: #22CC7C">Unirse</button>
                        </form>
                    @else
                        <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C"
                            href="{{ route('login') }}">Unete</a>
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

        @if ($campañas->count() > 0)
            <div class="w-full flex justify-around ">
                @foreach ($campañas as $campaña)
                    <div
                        style="width: 30%; height: 200px; background-color: #9823CC; border-radius: 10px; margin: 10px; padding: 10px;">
                        <div class="flex flex-col text-center align-middle"
                            style="width: 95%; height: 90%; background-color: #CC9523; border-radius: 10px; margin: 10px; padding: 10px;">
                            <h2 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white">
                                {{ $campaña->nombre }}
                            </h2>
                            <a class="px-3 py-2 text-lg text-white rounded mt-2 inline-block"
                                style="background-color: #22CC7C"
                                href="{{ route('campaña.mostrar', ['id' => $campaña->id]) }}">
                                entrar
                            </a>
                            <!-- Aquí puedes mostrar más detalles de la campaña si es necesario -->
                        </div>
                    </div>
                @endforeach
            </div>
        @else

        <div class="w-full text-center flex justify-center flex-row">
            <div
                style="width: 40%; height: auto; background-color: #FF4444; border-radius: 10px; padding: 10px; color: #fff; margin-top: 10px; margin-bottom:100px">
                <p>No se encontraron campañas para mostrar.</p>
            </div>
        </div>
        @endif

        {{ $campañas->links() }}
    @endsection





</x-app-layout>
