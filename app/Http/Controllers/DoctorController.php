<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Specialist;

class DoctorController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $doctors = Doctor::with('specialist')->withCount('schedules')->get();
        $specialists = Specialist::all();

        return view('doctor.index', [
            'title' => 'List Dokter',
            'today' => $today,
            'doctors' => $doctors,
            'specialists' => $specialists,
        ]);
    }


    public function show(Doctor $doctor)
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $doctor = $doctor->loadCount('schedules');

        return view('doctor.show', [
            'title' => 'Detail Dokter',
            'today' => $today,
            'doctor' => $doctor,
        ]);
    }

    public function create()
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $specialists = Specialist::all();

        return view('doctor.create', [
            'title' => 'Detail Dokter',
            'today' => $today,
            'specialists' => $specialists,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:doctors,email',
            'number'        => 'required|numeric',
            'specialist_id' => 'required|integer|exists:specialists,id',
            'working_days'  => 'required|array',
            'working_days.*'=> 'in:senin,selasa,rabu,kamis,jumat,sabtu,minggu'
        ]);



        try {
            $data['working_days'] = json_encode($data['working_days']);

            Doctor::create($data);

            return redirect('/doctor')->with('success', 'Data dokter berhasil ditambah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambah data dokter: ' . $e->getMessage());
        }
    }

    public function edit(Doctor $doctor)
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $specialists = Specialist::all();
        $workingDays = json_decode($doctor->working_days, true);

        return view('doctor.edit', [
            'title' => 'Detail Dokter',
            'today' => $today,
            'doctor' => $doctor,
            'specialists' => $specialists,
            'workingDays' => $workingDays,
        ]);
    }

    public function update(Doctor $doctor)
    {
        $data = request()->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'number'        => 'required|numeric',
            'specialist_id' => 'required|integer|exists:specialists,id',
            'working_days'  => 'required|array'
        ]);

        try {
            // Convert array to JSON before updating
            $data['working_days'] = json_encode($data['working_days']);

            // Update the doctor record
            $doctor->update($data);

            // Redirect with success message
            return redirect('/doctor')->with('success', 'Data dokter berhasil diperbarui');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data dokter: ' . $e->getMessage());
        }
    }


    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect('/doctor')->with('success', 'Data dokter berhasil dihapus');
    }
}
