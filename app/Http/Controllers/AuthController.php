<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Redirect::to('/')->with('status', 'Vous êtes déjà connecté.');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Récupérer l'utilisateur par email
        $user = User::where('email', $validated['email'])->first();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user); // Authentification manuelle
            $request->session()->regenerate();
            return redirect()->route('home')->with('status2', 'Bienvenue !');
        }

        // Retourner une erreur si l'authentification échoue
        return redirect()->route('login')->withErrors([
            'email' => 'Adresse email incorrecte',
            'password' => 'Mot de passe incorrect',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return Redirect::to('/login')->with('status1', 'Déconnecté avec succès');
    }
}
