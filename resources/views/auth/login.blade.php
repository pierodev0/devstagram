@extends('layouts.app')

@section('titulo')
    Inicia en Devstagram
@endsection

@section('contenido')
    <div class="lg:flex lg:justify-center">

        <div class="lg:w-4/12">    
            <img class="block h-full object-cover" src="{{ asset('img/login.jpg') }}" alt="imagen registro usuarios">
        </div> 

        <div class="lg:w-4/12 bg-white rounded-lg shadow-lg p-6">  
            <form method="post" action="{{ route('login.store') }}" class="flex flex-col gap-3" novalidate>

                @if (session('mensaje'))
                    <p class="bg-red-500 p-2 text-white text-center rounded">{{ session('mensaje') }}</p>
                @endif
                @csrf
                <x-campo nombreLabel="email" tipo="email" name="email"></x-campo>
                <x-campo nombreLabel="password" tipo="password" name="password"></x-campo>
                <div class="flex items-center gap-1">
                    <input id="remember" type="checkbox" name="remember"> <label for="remember" class="text-sm">Mantener mi sesion abierta</label>
                </div>
                <input type="submit" value="Iniciar sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection