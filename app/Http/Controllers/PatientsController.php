<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rapports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $patients = Patient::with('user')
            ->withCount('rapports')
            ->when($search, function ($query, $search): void {
                $query->where(function ($patientQuery) use ($search): void {
                    $patientQuery->whereHas('user', function ($userQuery) use ($search): void {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('patients.index', [
            'name' => $user->name,
            'Role' => $user->role,
            'patients' => $patients,
        ]);
    }

    public function edit(int $id)
    {
        $user = Auth::user();
        $patient = Patient::with('user')->findOrFail($id);

        return view('patients.edit', [
            'name' => $user->name,
            'Role' => $user->role,
            'patient' => $patient,
            'email' => $patient->user->email,
            'password' => $patient->user->password,
            'birth_date' => $patient->date_of_birth,
            'phone' => $patient->phone,
            'address' => $patient->address,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:3'],
            'birth_date' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated, $user, $patient): void {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => !empty($validated['password']) ? Hash::make($validated['password']) : $user->password,
            ]);

            $patient->update([
                'date_of_birth' => $validated['birth_date'],
                'phone' => $validated['phone'],
                'address' => $validated['address'] ?? null,
            ]);
        });

        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès.');
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('patients.dashboard', [
            'name' => $user->name,
            'Role' => $user->role,
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
                'Role' => 'patient',
            ]);

            Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $validated['birth_date'],
                'phone' => $validated['phone'],
                'address' => $validated['address'] ?? null,
            ]);
        });

        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès.');
    }


    public function delete($id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;

        if (Rapports::where('patient_id', $patient->id)->exists()) {
            return redirect()->route('patients.index')->with('error', 'Impossible de supprimer le patient car il a des rapports associés.');
        }

        DB::transaction(function () use ($patient, $user): void {
            $patient->delete();
            $user->delete();
        });
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
    }
}
