<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */

    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->created_at) {
                // Formatea la fecha si es necesario
                $user->formatted_created_at = $user->created_at->format('d/m/Y');
            } else {
                $user->formatted_created_at = 'No disponible';
            }
        }
        return view('users.tableuser', ['users' => $users]);
    }

    public function create()
    {
        return view('users.createuser');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Crear el nuevo usuario
            User::create([
                'name' => $request['first_name'] . ' ' . $request['last_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            return redirect('/dashboard')->with('success', 'Usuario registrado con éxito.');
        } catch (\Exception $e) {
            // Capturar cualquier excepción y mostrar un mensaje de error
            return back()->withErrors(['error' => 'No se pudo registrar el usuario. Inténtelo de nuevo.']);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user-management')->with('success', 'Usuario eliminado con éxito.');
    }
}
