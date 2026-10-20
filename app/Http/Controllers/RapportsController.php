<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\Rapports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RapportsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rapports = Rapports::with(['patient.user', 'doctor.user'])->get();
        return view('rapports.index', [
            'name' => $user->name,
            'Role' => $user->role,
            'rapports' => $rapports,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $patients = Patient::all();
        $doctors = Doctors::all();

        return view('rapports.create', [
            'name' => $user->name,
            'Role' => $user->role,
            'patients' => $patients,
            'doctors' => $doctors,
        ]);
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'pdf_file' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            
        ]);
        
        DB::transaction(function () use ($validated): void {
            $pdfFile = request()->file('pdf_file');
            $pdfFilePath = $pdfFile->store('rapports', 'public');

            $newFileName = 'rapports/' . $validated['title'] . '_' . date('Y-m-d_H-i-s') . '.pdf';
            $newFilePath = storage_path('app/public/' . $newFileName);
            rename(storage_path('app/public/' . $pdfFilePath), $newFilePath);
            $pdfFilePath = $newFileName;

            //dd($pdfFilePath);


            $rapport = new Rapports();
            $rapport->title = $validated['title'];
            $rapport->patient_id = $validated['patient_id'];
            $rapport->doctor_id = $validated['doctor_id'];
            $rapport->uploaded_by = Auth::id();
            $rapport->file_path = $pdfFilePath;

            $rapport->saveOrFail();
            
        });

       

        return redirect()->route('rapports.index')->with('success', 'Rapport médical créé avec succès.');


   
    }

    public function delete(int $id)
    {
        $rapport = Rapports::findOrFail($id);
        $rapport->delete();

        return redirect()->route('rapports.index')->with('success', 'Rapport médical supprimé avec succès.');
    } 

    public  function show(int $id)
    {
        $user = Auth::user();
        $rapport = Rapports::with(['patient.user', 'doctor.user'])->findOrFail($id);

        return view('rapports.show', [
            'name' => $user->name,
            'Role' => $user->role,
            'rapport' => $rapport,
        ]);
    }

    public function edit(int $id)
    {
        $user = Auth::user();
        $rapport = Rapports::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctors::all();

        return view('rapports.edit', [
            'name' => $user->name,
            'Role' => $user->role,
            'rapport' => $rapport,
            'patients' => $patients,
            'doctors' => $doctors,
        ]);


    }

    public function update(int $id)
    {
        $validated = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $rapport = Rapports::findOrFail($id);


        DB::transaction(function () use ($rapport, $validated): void {
            if (request()->hasFile('pdf_file')) {
                $pdfFile = request()->file('pdf_file');
                $pdfFilePath = $pdfFile->store('rapports', 'public');
                $rapport->file_path = $pdfFilePath;
            }

            $rapport->title = $validated['title'];
            $rapport->patient_id = $validated['patient_id'];
            $rapport->doctor_id = $validated['doctor_id'];

            $rapport->saveOrFail();
        });

        return redirect()->route('rapports.index')->with('success', 'Rapport médical mis à jour avec succès.');
    }

    public function download(int $id)
    {
        $rapport = Rapports::findOrFail($id);
        return response()->download(storage_path('app/public/' . $rapport->file_path));
    }

    
}
