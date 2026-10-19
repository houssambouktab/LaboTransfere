<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index(request $request)
    {
        $user = Auth::user();

        $search = $request->input('search');


         $patients = Patient::with('user')->get();

        //  $patientsRapports = Rapports::with('user')->get();

        // $patients = Patient::with('user')
        //     ->whereHas('user', function ($query) use ($search) {
        //         $query->where('name', 'like', "%$search%")
        //             ->orWhere('email', 'like', "%$search%");
        //     })->get();


        return view('patients.index', [
            'name' => $user->name,
            'Role' => $user->role,
            'patients' => $patients,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        return view('patients.create', [
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
            'birth_date' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated): void {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'patient',
            ]);

            Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $validated['birth_date'],
                'phone' => $validated['phone'],
                'address' => $validated['address'] ?? null,
            ]);
        });

        return redirect()->route('patients.patients')->with('success', 'Patient ajouté avec succès.');
    }
}
