@extends('layouts.app')

@section('titulo')
    Crear un post
@endsection

@push('styles')
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

@section('contenido')
    <div class="lg:grid grid-cols-2 gap-5">
        <div class="">
            <form action="{{ route('imagenes.store') }}" id="dropzone" method="POST" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <form class="p-4 bg-white rounded shadow flex flex-col gap-3" action="{{ route('posts.store') }}" method="POST" novalidate>
            @csrf
            <x-campo nombreLabel="Titulo de la publicacion" tipo="text" name="titulo"></x-campo>
            <div>
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion de la
                    publicacion</label>
                <textarea id="descripcion"
                    name="descripcion"
                    class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-2 rounded-lg bg-red-500 text-center text-white text-sm p-2">{{ $message }}</p>
                @enderror

                <div>
                    <input type="hidden" name="imagen" id="imagen-post" value="{{ old('imagen') }}">
                     @error('imagen')
                     <p class="mt-2 rounded-lg bg-red-500 text-center text-white text-sm p-2">{{ $message }}</p>
                     @enderror
                </div>
            </div>
            <input type="submit" value="Crear publicacion"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg">
        </form>
    </div>
@endsection
