@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST" id="edit-schedule-form">
        @csrf
        @method('PUT')
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <label for="patient_id" class="block text-sm font-medium text-gray-700">Pasien</label>
                <select name="patient_id" id="patient_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id', $schedule->patient_id) == $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }}
                        </option>
                    @endforeach
                </select>
                @error('patient_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="queue_number" class="block text-sm font-medium text-gray-700">Nomor Antrian</label>
                <input type="number" name="queue_number" id="queue_number" value="{{ old('queue_number', $schedule->queue_number) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2">
                @error('queue_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="complaint" class="block text-sm font-medium text-gray-700">Keluhan</label>
                <textarea name="complaint" id="complaint" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2">{{ old('complaint', $schedule->complaint) }}</textarea>
                @error('complaint')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="payment" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="payment" id="payment" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2">
                    <option value="BPJS" {{ old('payment', $schedule->payment) == 'BPJS' ? 'selected' : '' }}>BPJS</option>
                    <option value="tunai" {{ old('payment', $schedule->payment) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="asuransi" {{ old('payment', $schedule->payment) == 'asuransi' ? 'selected' : '' }}>Asuransi</option>
                </select>
                @error('payment')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="doctor_id" class="block text-sm font-medium text-gray-700">Dokter</label>
                <select name="doctor_id" id="doctor_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ old('doctor_id', $schedule->doctor_id) == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="consultation_time" class="block text-sm font-medium text-gray-700">Waktu Konsultasi</label>
                <input type="datetime-local" name="consultation_time" id="consultation_time" 
                    value="{{ old('consultation_time', \Carbon\Carbon::parse($schedule->consultation_time)->format('Y-m-d\TH:i')) }}" 
                    required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                @error('consultation_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Jadwal</button>
            </div>
        </div>
    </form>
</div>
@endsection
