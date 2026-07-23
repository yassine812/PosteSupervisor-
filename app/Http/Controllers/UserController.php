<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('users.gestionusers',compact('users'));
}
    public function create(){
        return view('users.create');



}
public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|string|email|unique:users,email',
        'phoneNumber' => 'required|string|min:8|max:15',
        'password' => 'required|string',
        'confirmerPassword' => 'required|string|same:password',
    ]);
    unset($validated['confirmerPassword']);

    // Hachage du mot de passe
    $validated['password'] = bcrypt($validated['password']);

    // Sauvegarde des données
    User::create($validated);



    return redirect()->route('users.create')->with('success', 'Utilisateur ajouté avec succès');
}
public function edit($id){
    $user = User::find($id);
    return view('users.edit', compact('user'));
}
public function admin($id)
{
    $user = User::findOrFail($id); // Retrieve the user from the database
    return view('users.admin', compact('user')); // Pass $user to the view
}

public function update(Request $request, $id){
    $request->validate([
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|string|email|unique:users,email,'.$id,
        'phoneNumber' => 'required|string|min:8|max:15',
        'password' => 'required|string',
    ]);
    User::findOrfail($id)->update([
        'firstname' => $request->input('firstname'),
        'lastname' => $request->input('lastname'),
        'email' => $request->input('email'),
        'phoneNumber' => $request->input('phoneNumber'),
        'password' => $request->input('password'),
    ]);
    return redirect()->back()->with('update', 'Utilisateur modifié avec succès');
}
    public function destroy($id){
        User::findOrfail($id)->delete();
        return redirect()->back()->with('delete', 'Utilisateur supprimé avec succès');
    }

    /**
     * Upload user profile photo.
     */
    public function uploadAvatar(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|max:800', // 800Ko max
        ]);

        $user = User::findOrFail($id);

        // Delete old avatar file if it exists
        if ($user->profile_photo_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Store new avatar file in public disk
        $path = $request->file('avatar')->store('avatars', 'public');

        $user->profile_photo_path = $path;
        $user->save();

        return back()->with('update', 'Photo de profil mise à jour avec succès.');
    }

    /**
     * Delete user profile photo.
     */
    public function deleteAvatar($id): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->profile_photo_path) {
            // Delete file from storage
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo_path);
            
            // Set path to null in database
            $user->profile_photo_path = null;
            $user->save();
        }

        return back()->with('update', 'Photo de profil supprimée avec succès.');
    }
}
