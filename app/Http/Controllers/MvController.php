<?php

namespace App\Http\Controllers;

use App\Models\Mv;
use Illuminate\Http\Request;

class MvController extends Controller
{
    public function index()
    {
        $mvs = Mv::all(); // Using all() instead of get() for brevity
        return view('mv.gestionvm', compact('mvs'));
    }

    public function form()
    {
        return view('mv.createvm');
    }

    public function store1(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|min:2',
            'ipadress' => 'required|string',
            'statut' => 'required|string',
        ]);

        // Map statut value
        $validated = $request->only(['name', 'ipadress']);
        if ($request->statut === '1') {
            $validated['statut'] = 'Actif';
        } elseif ($request->statut === '0') {
            $validated['statut'] = 'Non Actif';
        } else {
            return back()->withErrors(['statut' => 'Statut must be 1 or 0.'])->withInput();
        }

        // Create new Mv record
        Mv::create($validated);

        return redirect()->route('mvs.form')->with('success', 'Machine virtuelle ajoutée avec succès');
    }

    public function edit($id)
    {
        $mv = Mv::findOrFail($id); // Ensure record exists
        return view('mv.editvm', compact('mv'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|min:2',
            'ipadress' => 'required|string',
            'statut' => 'required|string',
        ]);

        // Map statut value
        $data = $request->only(['name', 'ipadress']);
        if ($request->statut === '1') {
            $data['statut'] = 'Actif';
        } elseif ($request->statut === '0') {
            $data['statut'] = 'Non Actif';
        } else {
            return back()->withErrors(['statut' => 'Statut must be 1 or 0.'])->withInput();
        }

        // Update Mv record
        Mv::findOrFail($id)->update($data);

        return redirect()->back()->with('modifier1', 'Machine virtuelle modifiée avec succès');
    }

    public function destroy($id)
    {
        Mv::findOrFail($id)->delete();
        return redirect()->back()->with('delete1', 'Machine virtuelle supprimée avec succès');
    }
}
