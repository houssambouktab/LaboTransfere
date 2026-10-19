<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $doctors = Doctors::with('user')->get();
        

        // $doctorsrapports = Doctors::with('rapports')->get();
        return view('medecins.index', [
            'name' => $user->name,
            'Role' => $user->role,
            'doctors' => $doctors,
            // 'doctorsrapports' => $doctorsrapports,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        return view('medecins.create', [
            'name' => $user->name,
            'Role' => $user->role,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3'],
            'specialty' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated): void {
           $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'doctor',
            ]);

            Doctors::create([
                'user_id' => $user->id,
                'specialty' => $validated['specialty'],
                'phone' => $validated['phone'],
                
            ]);
        });

        return redirect()->route('medecins.doctors')->with('success', 'Médecin ajouté avec succès.');
    }
}
