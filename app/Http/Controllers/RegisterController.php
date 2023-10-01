<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)

    
    {

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

       //Validacion
       $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|alpha_dash|min:3|max:20|unique:users',
            'email'=> 'required|email|max:60|unique:users',
            'password'=> 'required|min:6|confirmed'
       ]);

       User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
       ]);

       //Autenticar el usuario
        //    auth()->attempt([
        //         'email' => $request->email,
        //         'password' => $request->password,
        //    ]);

        auth()->attempt($request->only('email','password'));

       //Redireccionar al usuario
       return redirect()->route('posts.index');

    }
}
