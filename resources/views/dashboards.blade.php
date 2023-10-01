@extends('layouts.app')

@section('titulo')
  Perfil: {{ $user->username }}
@endsection

@section('contenido')
  <div class="grid gap-y-10">
    <div class="flex justify-center">
      <div class="flex w-full flex-col items-center justify-center gap-3 md:w-8/12 md:flex-row md:justify-start lg:w-6/12">
        <div class="md: w-8/12 px-5 lg:w-6/12">
          <img
            src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}"
            alt="Imagen del usuario"
            class="rounded-full"
          >
        </div>
        <div class="px-5 md:w-8/12 lg:w-6/12">
          <p class="mb-3 text-2xl text-gray-700">
          <div class="flex items-center gap-2">
            <p class="text-2xl text-gray-700">{{ $user->username }}</p>
            @auth
              @if ($user->id === auth()->user()->id)
                <a
                  href="{{ route('perfil.index') }}"
                  class="text-gray-500 hover:text-gray-700"
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="h-5 w-5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                    />
                  </svg></a>
              @endif
            @endauth
          </div>
          </p>
          <p class="text-sm font-bold text-gray-800">{{ $user->followers->count() }}<span class="font-normal">
              @choice('Seguidor|Seguidores', $user->followers->count())</span></p>
          <p class="text-sm font-bold text-gray-800">{{ $user->followings->count() }}<span class="font-normal">
              Siguiendo</span></p>
          <p class="text-sm font-bold text-gray-800">{{ $user->posts->count() }}<span class="font-normal">
              Posts</span>
          </p>
          @auth
            @if ($user->id !== auth()->user()->id)
              @if (!$user->siguiendo(auth()->user()))
                <form
                  action="{{ route('users.follow', $user) }}"
                  method="POST"
                >
                  @csrf
                  <input
                    type="submit"
                    class="cursor-pointer rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold uppercase text-white"
                    value="Seguir"
                  >
                </form>
              @else
                <form
                  action="{{ route('users.unfollow', $user) }}"
                  method="POST"
                >
                  @method('delete')
                  @csrf
                  <input
                    type="submit"
                    class="cursor-pointer rounded-lg bg-red-600 px-3 py-1 text-xs font-bold uppercase text-white"
                    value="Dejar de seguir"
                  >
                </form>
              @endif
            @endif
          @endauth
        </div>
      </div>
    </div>

    <section class="container mx-auto grid gap-5">
      <h2 class="text-center text-4xl font-black">Publicaciones</h2>

      <x-listar-post :posts="$posts" />

    </section>
  </div>
@endsection

