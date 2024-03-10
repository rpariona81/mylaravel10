<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function acceder()
    {
        return view('auth.login');
    }


    public function autenticar(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials['status'] = 1;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin')->withSuccess('Bienvenido al panel de administración');
        }

        return back()->withErrors([
            'email' => 'El email no está registrado.'
        ]);
    }

    public function registro()
    {
        return view('auth.registro');
    }

    public function registrarse(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:t_users',
            'password' => 'required|confirmed|min:6'
        ]);

        $data = $request->all();

        $usuario = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($usuario);

        return redirect('admin')->withSuccess('Te has registrado correctamente. Bienvenido!!');
    }

    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
