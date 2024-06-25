<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect('login')->withErrors('Login details are not valid');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'sexo' => 'required|integer|between:0,2',
            'role' => 'required|in:doctor,secretaria',
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sexo' => $request->sexo,
            'role' => $request->role,
        ]);

        // Determinar la redirección basada en el rol del usuario registrado
        if ($request->role == 'doctor') {
            //aqui el doctor
            return redirect()->route('auth.home');
        } elseif ($request->role == 'secretaria') {
            // secretariaa
            return redirect()->route('citas.index');
        }

        
        return redirect()->intended('home');
    }

    public function home()
    {
        return view('auth.home');
    }
}
