<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use App\Models\Rapports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $doctors = Doctors::with('user')
            ->select('doctors.*')
            ->selectSub(function ($query) {
                $query->from('rapports')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('rapports.doctor_id', 'doctors.id');
            }, 'rapports_count')
            ->when($search, function ($query, $search): void {
                $query->where(function ($doctorQuery) use ($search): void {
                    $doctorQuery->whereHas('user', function ($userQuery) use ($search): void {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhere('phone', 'like', "%{$search}%");
                });
            })->get();




        // $doctorsrapports = Doctors::with('rapports')->get();
        return view('medecins.index', [
            'name' => $user->name,
            'Role' => $user->role,
            'doctors' => $doctors,
            // 'doctorsrapports' => $doctorsrapports,
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();


        $rapports = Rapports::with(['patient.user', 'doctor.user'])
            ->whereHas('doctor', function ($query): void {
                $query->where('user_id', Auth::id());
            })
            ->where('status', 'sent')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medecins.dashboard', [
            'name' => $user->name,
            'Role' => $user->role,
            'rapports' => $rapports,
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
                'Role' => 'doctor',
            ]);

            Doctors::create([
                'user_id' => $user->id,
                'specialty' => $validated['specialty'],
                'phone' => $validated['phone'],

            ]);
        });

        return redirect()->route('medecins.index')->with('success', 'Médecin ajouté avec succès.');
    }



    public function delete(int $id)
    {
        $doctor = Doctors::findOrFail($id);
        $user = $doctor->user;

        db::transaction(function () use ($doctor, $user): void {
            $doctor->delete();
            $user->delete();
        });

        return redirect()->route('medecins.index')->with('success', 'Médecin supprimé avec succès.');


    }

    public function edit(int $id)
    {

        $doctor = Doctors::findOrFail($id);
        $user = $doctor->user;

        return view('medecins.edit', [
            'name' => $user->name,
            'Role' => $user->role,
            'doctor' => $doctor,
            'email' => $user->email,
            'password' => $user->password,
            'specialty' => $doctor->specialty,
            'phone' => $doctor->phone,
        ]);
    }

    public function update(int $id, Request $request)
    {
        $doctor = Doctors::findOrFail($id);
        $user = $doctor->user;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:3'],
            'specialty' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($doctor, $user, $validated): void {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => !empty($validated['password']) ? Hash::make($validated['password']) : $user->password,
            ]);

            $doctor->update([
                'specialty' => $validated['specialty'],
                'phone' => $validated['phone'],
            ]);
        });

        return redirect()->route('medecins.index')->with('success', 'Médecin mis à jour avec succès.');
    }
}
