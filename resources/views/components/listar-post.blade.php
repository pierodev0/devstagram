<div>
    @if ($posts->count())
    <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($posts as $post)
          <figure>
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
              <img
                class="aspect-square bg-blue-400"
                src="{{ asset('uploads' . '/' . $post->imagen) }}"
                alt="Imagen del post"
                loading="lazy"
              >
            </a>
          </figure>
        @endforeach
      </div>
      <div>
        {{ $posts->links('pagination::tailwind') }}
      </div>
    @else
        <p>No hay posts</p>
    @endif
</div>
