<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'alpha_dash', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter'],
            'email' => ['required', 'email', 'min:3', 'max:20', 'unique:users,email,' . auth()->user()->id,],
        ]);

        if($request->filled('old_password')){

            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with('mensaje','Contraseña incorrecta. Por favor, inténtalo de nuevo.');
            }

            $request->validate([
                'password'=> 'min:6|confirmed',
            ]);
        }


        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);

            $imagenServidor->fit(1000, 1000);


            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->password = $request->password ?? auth()->user()->password;

        $usuario->save();

        //Redireccionar al usuario
        return redirect()->route('posts.index',$usuario->username);
    }
}
