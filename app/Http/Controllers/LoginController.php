<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Types;
use App\Models\Type;
use Carbon\Carbon;

class LoginController extends Controller
{
    function Return_Vieuw_login()
    {

        return view('login');
    }

    function Traitement_Login(RequestLogin $request)
    {
        $user = $request->validated();

        if (Auth::attempt($user)) {

        // Récupérer l'utilisateur authentifié
            $authenticatedUser = Auth::user();

            // Vérifier si l'utilisateur n'a pas le rôle 2
            if ($authenticatedUser->role != 2) {
                $request->session()->regenerate();
                return redirect(route('dashbord'))->with('success', 'Connexion réussie');
            } else {
                // Déconnexion si le rôle n'est pas autorisé
                Auth::logout();
                return back()->with([
                    'error' => 'Votre compte n\'a pas ete activer.'
                ]);
            }
        }
        return back()->withErrors([
            'email' => 'email incorrect',
            'password' => 'Mot de passe incorrect'
        ]);
    }

    function Traitement_Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('error', 'Deconnexion reussit');
    }
}
