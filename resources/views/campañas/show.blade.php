<x-app-layout title="Home Page">
    @section('hero')
        <h1 class="text-center text-2xl md:text-3xl font-bold lg:text-5xl mt-8"> {{ $campaña->nombre }}</h1>
        <h2 class="text-center text-2xl md:text-3xl font-bold lg:text-5xl mt-8"> {{ $campaña->codigo }}</h1>

            <div class="w-full text-center py-8 flex justify-center">
                <div style="width:90%; height:500px;background-color:#9823CC;border-radius: 30px"
                    class="flex flex-row items-center justify-evenly">
                    <div style="height:400px;width:400px;">
                        <img src="https://www.glassstaff.com/cdn/shop/articles/staredown-d20.jpg?v=1677872863&width=2048"
                            style="height:400px;width:400px;border-radius:30px"></img>
                    </div>
                    <div
                        style="height: 400px; width: 65%; background-color: #CC9523; border-radius: 30px; display: flex; flex-wrap: wrap;">
                        @foreach ($creadores as $usuario)
                            <div style="width: 25%; padding: 5px; box-sizing: border-box; text-align: center;">
                                <img src="{{ $usuario->profile_photo_url }}" alt="Avatar de {{ $usuario->name }}"
                                    style="border-radius: 50%; width: 100px; height: 100px;">
                                <p>{{ $usuario->name }}</p>
                            </div>
                        @endforeach

                        @foreach ($jugadores as $usuario)
                            <div style="width: 25%; padding: 5px; box-sizing: border-box; text-align: center;">
                                <img src="{{ $usuario->profile_photo_url }}" alt="Avatar de {{ $usuario->name }}"
                                    style="border-radius: 50%; width: 100px; height: 100px;">
                                <p>{{ $usuario->name }}</p>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>

            </div>
        @endsection







</x-app-layout>
