@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container px-3 grid md:grid-cols-2 gap-5">
        <div>
            <figure class="bg-sky-400 aspect-square">
                <img src="{{ asset('uploads' . '/' . $post->imagen) }}" alt="Imagen del post">
            </figure>
            <div class="p-3">
                <div class="flex justify-between items-center">
                    <div class="flex justify-center items-center gap-3">
                        @auth
                        <livewire:like-post :post="$post"/>
                        @endauth
                    </div>
                    @auth
                        @if ($post->user_id === auth()->user()->id)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Eliminar post"
                                    class=" cursor-pointer bg-red-500 p-3 hover:bg-red-700 font-bold uppercase text-white rounded-lg">
                            </form>
                        @endif
                    @endauth
                </div>
                <div>
                    <p class="font-bold">{{ $post->user->username }}</p>
                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    <p>{{ $post->descripcion }}</p>
                </div>
            </div>
        </div>

        <div class="shadow bg-white p-5 flex flex-col gap-4 lg:max-h-full lg:overflow-y-scroll">
            @auth
                <form method="POST" action="{{ route('comentarios.store', ['user' => $user, 'post' => $post]) }}"
                    class="flex flex-col gap-4">
                    @csrf
                    <x-text-area nombreLabel="Agrega un comentario" name="comentario"></x-text-area>
                    <input type="submit" value="Agregar comentario"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 text-white rounded-lg">
                </form>
            @endauth
            @if ($post->comentarios->count())
                <div>
                    @foreach ($post->comentarios->reverse() as $comentario)
                        <div class="shadow p-2 rounded-lg">
                            <a class="font-bold"
                                href="{{ route('posts.index', $comentario->user) }}">{{ $comentario->user->username }}</a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No hay comentarios</p>
                </div>
            @endif

        </div>
    </div>
@endsection
