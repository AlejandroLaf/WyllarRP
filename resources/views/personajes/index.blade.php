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
    @endsection
</x-app-layout>
