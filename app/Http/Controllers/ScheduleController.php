<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(): JsonResponse
    {
        $schedules = Schedule::with(['patient', 'doctor'])->get();
        return response()->json($schedules);
    }

    public function show(Schedule $schedule): JsonResponse
    {
        return response()->json($schedule->load(['patient', 'doctor']));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'complaint'         => 'required|string|max:255',
            'payment'           => 'required|in:BPJS,Tunai,Asuransi',
            'doctor_id'         => 'required|exists:doctors,id',
            'consultation_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $schedule = Schedule::create($data);

        return response()->json($schedule->load(['patient', 'doctor']), 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $schedule = Schedule::findOrFail($id);

        $data = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'complaint'         => 'required|string|max:255',
            'payment'           => 'required|in:BPJS,Tunai,Asuransi',
            'doctor_id'         => 'required|exists:doctors,id',
            'consultation_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $schedule->update($data);

        return response()->json($schedule->load(['patient', 'doctor']));
    }

    public function destroy(Schedule $schedule): JsonResponse
    {
        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully']);
    }
}
