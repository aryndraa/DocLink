<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\JsonResponse;

class JadwalPasienController extends Controller
{
    public function index(): JsonResponse
    {
        $patients = Patient::with('schedules')->get();
        return response()->json($patients);
    }

    public function show(Patient $patient): JsonResponse
    {
        return response()->json($patient->load('schedules')); 
    }

    public function store(): JsonResponse
    {
        $data = request()->validate([
            'name'   => 'required|string|max:255',
            'number' => 'required|numeric',
        ]);

        $patient = Patient::create($data);
        return response()->json($patient, 201);
    }

    public function update($id): JsonResponse
    {
        $patient = Patient::findOrFail($id); 

        $data = request()->validate([
            'name'   => 'required|string|max:255',
            'number' => 'required|numeric',
        ]);
    
        $patient->update($data);
        return response()->json($patient->fresh());
    }
    
    public function destroy(Patient $patient): JsonResponse
    {
        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully'],);
    }
}
