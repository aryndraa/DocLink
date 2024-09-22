<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::withCount('schedules')->get();
        $title = 'List Pasien';
        return view('patient.index', compact('patients', 'title'));
    }

    public function show(Patient $patient)
    {
        $patient->load('schedules');
        $title = 'Detail Pasien';
        return view('patient.show', compact('patient', 'title'));
    }

    public function create()
    {
        $title = 'Daftarkan Pasien';
        return view('patient.create', compact('title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'number' => 'required|numeric',
        ]);

        Patient::create($data);
        return redirect()->route('patient.index')->with('success', 'Daftar Pasien berhasil terdaftar!');
    }

    public function edit(Patient $patient)
    {
        $title = 'Edit Pasien';
        return view('patient.edit', compact('patient', 'title')); 
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'number' => 'required|numeric',
        ]);

        $patient->update($data);
        return redirect()->route('patient.index')->with('success', 'Informasi pasien berhasil diperbarui!');
    }

    public function destroy(Patient $patient)
    {
        try {
            $patient->schedules()->delete();
            
            $patient->delete();
    
            return redirect()->route('patient.index')->with('success', 'Daftar Pasien berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('patient.index')->with('error', 'Gagal menghapus daftar pasien: ' . $e->getMessage());
        }
    }
    
}

