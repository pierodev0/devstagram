@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="w-3/4 bg-white shadow-sm p-6">
            <form action="{{ route('perfil.store') }}" class="flex flex-col gap-3" enctype="multipart/form-data" method="POST">
                @csrf
                <div>
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username"
                        class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror"
                        value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="mt-2 rounded-lg bg-red-500 text-center text-white text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email"
                        class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror"
                        value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="mt-2 rounded-lg bg-red-500 text-center text-white text-sm p-2">{{ $message }}</p>
                    @enderror
                </div>

                <p class=" uppercase underline font-bold text-gray-500 text mt-4">Cambiar contraseña</p>
                <div class="uppercase font-bold flex flex-col gap-2">
                    <x-campo nombreLabel="Antiguo password" tipo="password" name="old_password"></x-campo>
                    @if (session('mensaje'))
                        <p class="bg-red-500 p-2 text-white text-center rounded">{{ session('mensaje') }}</p>
                    @endif
                    <x-campo nombreLabel="Nuevo password" tipo="password" name="password"></x-campo>

                    <x-campo nombreLabel="repetir password" tipo="password" name="password_confirmation"></x-campo>
                </div>



                <div>
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">imagen</label>
                    <input type="file" id="imagen" name="imagen"
                        class="border p-3 w-full rounded-lg @error('imagen')
                        border-red-500
                    @enderror"
                        value="" accept=".jpg, .jpeg, .png">

                </div>

                <input type="submit" value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg">
            </form>

        </div>
    </div>
@endsection
