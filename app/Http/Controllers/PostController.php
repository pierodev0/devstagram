<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show','index');
    }
    
    public function index(User $user)
    {
        $posts = Post::where('user_id',$user->id)
        ->orderBy('created_at', 'desc')->paginate(5);

        return view('dashboards',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create(User $user)
    {   
        return view('posts.create');
    }

    public function store(Request $request)
    {       
       

        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,
        // ]);

        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();        
        

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen
        ]);

        return redirect()->route('posts.index',auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show',[
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
       
        $this->authorize('delete',$post);
        $post->delete();

        //Eliminar imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
