<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Paciente; 
use App\Models\Medico; // Importar el modelo Medico
use App\Models\Cita;

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

    public function destroyPaciente($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente.');
    }

    public function destroyMedico($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return redirect()->route('medicos.index')->with('success', 'Médico eliminado exitosamente.');
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

        return redirect()->intended('home');
    }

    public function home()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        $citas = Cita::all();
        return view('auth.home', compact('pacientes','medicos','citas'));
    }

    public function showPacientes()
    {
        $pacientes = Paciente::all();
        return view('auth.pacientes', compact('pacientes'));
    }

    public function showMedicos()
    {
        $medicos = Medico::all();
        return view('auth.medico', compact('medicos'));
    }

    public function storePaciente(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'genero' => 'required|string|max:10',
            'edad' => 'required|integer|min:0',
            'fecha_nac' => 'required|date',
            'email' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        $paciente = Paciente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'genero' => $request->genero,
            'edad' => $request->edad,
            'fecha_nac' => $request->fecha_nac,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado exitosamente.');
    }

    public function storeMedico(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'consultorio' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
        ]);

        $medico = Medico::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'especialidad' => $request->especialidad,
            'consultorio' => $request->consultorio,
            'edad' => $request->edad,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico creado exitosamente.');
    }


    
}
