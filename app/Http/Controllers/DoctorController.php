<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('specialist')->get();
        return response()->json($doctors);
    }


    public function show(Doctor $doctor)
    {
        return response()->json($doctor->load('specialist')); 
    }

    public function store()
    {
        $data = request()->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:doctors,email',
            'number'        => 'required|numeric',
            'specialist_id' => 'required|integer|exists:specialists,id',
            'working_days'  => 'required|string'
        ]);

        $doctor = Doctor::create($data);
        return response()->json($doctor, 201);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted successfully']);
    }
}
