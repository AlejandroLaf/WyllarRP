<x-app-layout title="Home Page">
    @section('hero')

    <h1 class="text-center text-2xl md:text-3xl font-bold lg:text-5xl mt-8"> {{ $campaña->nombre }}</h1>
    <h2 class="text-center text-2xl md:text-3xl font-bold lg:text-5xl mt-8"> {{ $campaña->codigo }}</h1>

    @endsection







</x-app-layout>
