<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Mv;

class TemplateController extends Controller
{
    public function index(){
        $usersCount = User::count();
        $mvsCount = Mv::count();
        $activeMvsCount = Mv::where('statut', 'Active')->count();
        $inactiveMvsCount = Mv::where('statut', 'Inactive')->count();
        
        return view('home', compact('usersCount', 'mvsCount', 'activeMvsCount', 'inactiveMvsCount'));
    }

    /**
     * Handle first login organization setup.
     */
    public function setup(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'organization_logo' => 'nullable|image|max:1024', // 1Mo max
            'timezone' => 'required|string',
            'language' => 'required|string|in:fr,en,ar'
        ]);

        $user = auth()->user();
        $user->organization_name = $request->input('organization_name');
        $user->timezone = $request->input('timezone');
        $user->language = $request->input('language');

        if ($request->hasFile('organization_logo')) {
            // Delete old logo if it exists
            if ($user->organization_logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->organization_logo);
            }
            // Store new logo
            $path = $request->file('organization_logo')->store('logos', 'public');
            $user->organization_logo = $path;
        }

        $user->first_login = false;
        $user->save();

        return redirect()->route('home')->with('status2', 'Configuration initiale enregistrée avec succès !');
    }

    /**
     * Skip first login setup.
     */
    public function skipSetup(): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $user->first_login = false;
        $user->save();

        return redirect()->route('home')->with('status2', 'Configuration ignorée pour le moment.');
    }
}
