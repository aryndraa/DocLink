<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        // data time
        Carbon::setLocale('id');
        $today = strtolower(Carbon::now()->translatedFormat('l'));
        $date  = Carbon::now(); 

        // data / week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();

        // total patient per days
        $consultantPerDay = [];

        // patient on this week
        $totalPatientsPerWeeks = 0;

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $count = Schedule::whereDate('created_at', $date->toDateString())->count();
            $consultantPerDay[$date->format('l')] = $count; 
            $totalPatientsPerWeeks += $count; 
        }
        
        // get keys total consultants per day
        $daysOfWeek = array_keys($consultantPerDay);

        // get values total consultants per day
        $consultationData = array_values($consultantPerDay); 

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
        $doctorPatients = Doctor::query()
        ->withCount(['schedules' => function($query)  {
            $query->whereDate('created_at', Carbon::today());
        }])      
        ->distinct()
        ->get()
        ->take(5);
        
        // return response()->json([
        //     'consultantPerDay'      => $cons ultantPerDay,
        //     'totalPatientsToday'  => $totalPatientToday,
        //     'totalConsultantWeek' => $totalPatientsPerWeeks,
        //     'activeDoctor'        => $activeDoctor,
        //     'doctorPatient'       => $doctorPatient
        // ]);


        return view('dashboard.index', [
            'title' => 'Dashboard',
            'today' => $today,
            'totalPatientsPerWeeks' => $totalPatientsPerWeeks,
            'daysOfWeek' => $daysOfWeek,
            'consultationData' => $consultationData,
            'totalPatientToday' => $totalPatientToday,
            'activeDoctor' => $activeDoctor,
            'scheduleToday'=> $scheduleToday,
            'doctorPatients'       => $doctorPatients


        ]);
    }
}
