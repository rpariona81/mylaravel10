<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $credentials['activo'] = 1;

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('admin')->withSuccess('Bienvenido al panel de administración');
        }

        return back()->withErrors([
            'email' => 'El email no está registrado.'
        ]);
    }

}
