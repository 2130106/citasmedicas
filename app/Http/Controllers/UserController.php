<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        return view('auth.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'fecha_nac' => 'required|date',
        ]);

        $user->name = $request->name;
        $user->age = $request->age;
        $user->fecha_nac = $request->fecha_nac;
        $user->save();

        return redirect()->route('user.edit')->with('success', 'Perfil actualizado correctamente');
    }
}
