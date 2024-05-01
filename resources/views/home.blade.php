<x-app-layout title="Home Page">
    @section('hero')
        <div class="w-full text-center py-32 flex justify-center">
            <div style="width:90%; height:400px;background-color:#9823CC;border-radius: 30px" class="flex flex-row items-center justify-evenly">
                <div style="height:300px;width:300px;">
                    <img src="https://www.glassstaff.com/cdn/shop/articles/staredown-d20.jpg?v=1677872863&width=2048" style="height:300px;width:300px;border-radius:30px"></img>
                </div>
                <div style="height:300px;width:65%;background-color:#CC9523;border-radius: 30px">
                    <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white">
                        Bienvenidos a Wyllar RP
                    </h1>
                    <p class=" ext-lg mt-8">Esta es tu página de confianza donde podreis jugar y aprender todo lo necesario sobre Not so easy Fantasy</p>
                    <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C" href="">
                        Contempla el manual</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-full text-center pb-32 flex justify-around flex-row">
            <div style="width:40%; height:400px;background-color:#9823CC;border-radius: 30px" class="flex flex-row items-center justify-evenly">
                <div style="width: 90%;height:90%;background-color:#CC9523;border-radius: 30px" class="flex flex-col items-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white" style="margin-top: 120px">
                        EMPIEZA TU AVENTURA
                    </h1>
                    <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C" href="{{ route('home') }}">
                        Campañas
                    </a>
                </div>
            </div>

            <div style="width:40%; height:400px;background-color:#9823CC;border-radius: 30px" class="flex flex-row items-center justify-evenly">
                <div style="width: 90%;height:90%;background-color:#CC9523;border-radius: 30px">
                    <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl mt-8 text-white" style="margin-top: 120px">
                        CREA TU PERSONAJE
                    </h1>
                    <a class="px-3 py-2 text-lg text-white rounded mt-8 inline-block" style="background-color: #22CC7C;" href="">
                        Personajes
                    </a>
                </div>
            </div>

        </div>
    @endsection



</x-app-layout>
