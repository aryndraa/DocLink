<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['patient', 'doctor'])->get();
        Carbon::setLocale('id');

        $today = strtolower(Carbon::now()->translatedFormat('l'));
        return view('schedule.index', [
            'title' => 'Jadwal Konsulasi',
            'today' => $today,
            'schedules' => $schedules
        ]);
    }

    public function show(Schedule $schedule)
    {
     
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        
        return view('schedule.show', [
            'title' => 'Jadwal Konsulasi',
            'today' => $today,
            'schedule' => $schedule
        ]);
    }

    public function create()
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $patients = Patient::all(); // Fetch patients
        $doctors = Doctor::all(); // Fetch doctors
    
        return view('schedule.create', [
            'title' => 'Detail Konsultasi',
            'today' => $today,
            'patients' => $patients,
            'doctors' => $doctors,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'complaint'         => 'required|string|max:255',
            'payment'           => 'required|in:BPJS,tunai,asuransi',
            'doctor_id'         => 'required|exists:doctors,id',
            'consultation_time' => 'required',
            'queue_number'      => 'required|integer',
        ]);

        $schedule = Schedule::create($data);

        return redirect('/schedule')->with('success', 'Data Konsultasi berhasil ditambah');
    }

    public function edit(Schedule $schedule)
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $doctors = Doctor::all(); // Load all doctors
        $patients = Patient::all(); // Load all patients
    
        return view('schedule.edit', [
            'title' => 'Edit Konsultasi',
            'today' => $today,
            'schedule' => $schedule,
            'doctors' => $doctors, // Pass doctors to the view
            'patients' => $patients, // Pass patients to the view
        ]);
    }
    
  

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $data = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'queue_number'      => 'required|integer',
            'complaint'         => 'required|string|max:255',
            'payment'           => 'required|in:BPJS,tunai,asuransi',
            'doctor_id'         => 'required|exists:doctors,id',
            'consultation_time' => 'required',
        ]);

        $schedule->update($data);

        return redirect('/schedule')->with('success', 'Data Konsultasi berhasil diperbarui');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect('/schedule')->with('success', 'Data Konsultasi berhasil dihapus');

    }
}
