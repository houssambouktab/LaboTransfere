<?php

namespace App\Http\Controllers;

use App\Models\Rapports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role === 'doctor') {
            return redirect()->route('medecins.doctors');
        }

        if ($user->role === 'patient') {
            return redirect()->route('patients.patients');
        }

        $doctorsCount = User::where('role', 'doctor')->count();
        $patientsCount = User::where('role', 'patient')->count();
        $rapportsCount = Rapports::count();
        $raapports = Rapports::with(['patient.user', 'doctor.user'])->orderBy('created_at', 'desc')->take(5)->get();
        $rapportsPendingCount = Rapports::where('status', 'pending')->count();


        return view('welcome', [
            'name' => $user->name,
            'Role' => $user->role,
            'patientcount' => $patientsCount,
            'doctorcount' => $doctorsCount,
            'rapportscount' => $rapportsCount,
            'rapportspendingcount' => $rapportsPendingCount,
            'rapports' => $raapports,
        ]);
    }


    public function admin(){
        $user = Auth::user();


        return view('admin', [
            'name' => $user->name,


        ]);
    }


    // public function listusers(){

    // $users = User::get();

    // return $users;
    // }

    // public function insert(Request $request)
    // {
    //     $users = new User();
    //     $users->name = $request->input('name');
    //     $users->email = $request->input('email');
    //     $users->password = bcrypt($request->input('password'));
    //     $users->role = $request->input('role');
    //     $users->save();


    //     return redirect()->back()->with('success', 'User added successfully.');
    // }


}
