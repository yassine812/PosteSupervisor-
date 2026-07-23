<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{



    public function showlogin()
    {
        if (Auth::check()) {
            return Redirect::to('/')->with('status', 'You are already logged in.');
        }

        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('status2', 'Welcome back!');
        }
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }



    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return Redirect::to('/login')->with('status1', 'Logged out successfully');
}

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Upload user profile photo.
     */
    public function uploadAvatar(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|max:800', // 800Ko max
        ]);

        $user = auth()->user();

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
    public function deleteAvatar(): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();

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
