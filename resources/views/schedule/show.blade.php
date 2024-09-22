@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white p-6 w-[40%] rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Detail Konsultasi</h1>
                <a href="{{ route('schedule.index') }}" class="p-2 bg-gray-100 flex rounded-full">
                    <i class="bx bx-x"></i>
                </a>
            </div>
            <div class="flex flex-col gap-3 pb-3 border-b border-text/20 mb-8">
                <div class="border-b border-text/50 pb-2">
                    <h2 class="text-lg font-semibold">{{ $schedule->patient->name }}</h2>
                    <p class="text-base font-medium text-text/60">No Antrean : {{ $schedule->queue_number }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <h3 class="text-base font-semibold">Dokter Penangan </h3>
                    <p><p>{{ $schedule->doctor ? $schedule->doctor->name : 'Dokter tidak tersedia' }}</p></p>
                </div>
                <div class="flex justify-between items-center">
                    <h3 class="text-base font-semibold">Pembayaran </h3>
                    <p>{{ $schedule->payment }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <h3 class="text-base font-semibold">Waktu </h3>
                    <p>{{ $schedule->consultation_time }}</p>
                </div>
                <div class="">
                    <h3 class="text-base font-semibold mb-2">Keluhan  </h3>
                    <div class="bg-gray-100 p-4 rounded-xl">
                        <p>{{ $schedule->complaint }}</p> 
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('schedule.edit', $schedule) }}" class="px-4 py-1 border-2 rounded-lg text-primary font-medium border-primary">Edit</a>
                <form action="{{ route('schedule.destroy', $schedule) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-1 border-2 rounded-lg text-danger font-medium border-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection