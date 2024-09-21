<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Patient;

class DasboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));

        // data / week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        // total patient per days
        $patientsPerDay = [];

        // patient on this week
        $totalPatientWeek = 0;

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $count = Schedule::whereDate('created_at', $date->toDateString())->count();
            $patientsPerDay[$date->format('l')] = $count; 
            $totalPatientWeek += $count; 
        }

        // total data patients todayt
        $totalPatientToday = Patient::query()
            ->whereHas('schedules', function($query) use ($today) {
                $query->whereDate('consultation_time', Carbon::now()->format('Y-m-d'));
            })
            ->count();

        // Active Doctor
        $activeDoctor = Doctor::query()
            ->whereJsonContains('working_days', $today)
            ->get()
            ->take(5);

        // Schedule today
        $scheduleToday = Schedule::query()
            ->whereDate('consultation_time', Carbon::now()->format('Y-m-d'))
            ->get()
            ->take(5);

        // jadwal dokteer
        $doctorPatient = Doctor::query()
        ->withCount(['schedules' => function($query)  {
            $query->whereDate('created_at', Carbon::today());
        }])      
        ->distinct()
        ->get();
        
        return response()->json([
            'patientsPerDay'      => $patientsPerDay,
            'totalPatientsToday'  => $totalPatientToday,
            'totalConsultantWeek' => $totalPatientWeek,
            'activeDoctor'        => $activeDoctor,
            'scheduleToday'       => $scheduleToday,
            'doctorPatient'       => $doctorPatient
        ]);
    }
}
