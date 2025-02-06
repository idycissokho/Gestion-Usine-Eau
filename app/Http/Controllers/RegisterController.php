<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRegister;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function Return_view_register()
    {
        return view('register');
    }
    public function Traitement_register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($user) {
            $new_user = new User();
            $new_user->name = $user['name'];
            $new_user->email = $user['email'];
            $new_user->role = 2;
            $new_user->password = Hash::make($user['password']);
            $new_user->save();
            return redirect(route('login'))->with('success', 'Votre inscription a reussit !!! Attendez votre activation');
        }
    }


    public function activer(Request $request)
    {
        // Valider l'ID de l'utilisateur envoyé dans la requête
        $data = $request->validate([
            'id' => 'required|integer|exists:users,id',
        ]);

        // Trouver l'utilisateur par son ID
        $user = User::find($data['id']);

        // Vérifier si l'utilisateur a été trouvé et mettre le rôle à 0
        if ($user) {
            $user->role = 0;
            $user->save(); // Sauvegarder les changements

            return back()->with('success', "Le rôle de l'utilisateur a été mis à jour à 0.");
        }

        return back()->withErrors('Utilisateur non trouvé.');
    }


    public function desactiver(Request $request)
    {
        // Valider l'ID de l'utilisateur envoyé dans la requête
        $data = $request->validate([
            'id' => 'required|integer|exists:users,id',
        ]);

        // Trouver l'utilisateur par son ID
        $user = User::find($data['id']);

        // Vérifier si l'utilisateur a été trouvé et mettre le rôle à 0
        if ($user) {
            $user->role = 2;
            $user->save(); // Sauvegarder les changements

            return back()->with('success', "Le rôle de l'utilisateur a été desaactiver.");
        }

        return back()->withErrors('Utilisateur non trouvé.');
    }


    public function delete_user(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        // Récupération de l'utilisateur par ID
        $user = User::find($validated['id']);

        // Vérifiez si l'utilisateur existe avant de supprimer
        if ($user) {
            $user->delete(); // Suppression de l'utilisateur
            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Utilisateur introuvable.');
        }
    }

}
