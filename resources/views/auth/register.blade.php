@extends('layouts.app')

@section('titulo')
    Registrate en Devstagram
@endsection

@section('contenido')
    <div class="lg:flex lg:justify-center">

        <div class="lg:w-4/12">    
            <img class="block h-full object-cover" src="{{ asset('img/registrar.jpg') }}" alt="imagen registro usuarios">
        </div> 

        <div class="lg:w-4/12 bg-white rounded-lg shadow-lg p-6">  
            <form action="{{ route('register.index') }}" method="post" class="flex flex-col gap-3" novalidate>
                @csrf
                <x-campo nombreLabel="nombre" tipo="text" name="name"></x-campo>
                <x-campo nombreLabel="username" tipo="text" name="username"></x-campo>
                <x-campo nombreLabel="email" tipo="email" name="email"></x-campo>
                <x-campo nombreLabel="password" tipo="password" name="password"></x-campo>
                <x-campo nombreLabel="repetir password" tipo="password" name="password_confirmation"></x-campo>
                <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection