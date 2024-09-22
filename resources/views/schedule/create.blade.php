@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

    <form id="schedule-form" action="{{ route('schedule.store') }}" method="POST">
        @csrf
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <label for="patient_id" class="block text-sm font-medium text-gray-700">Pilih Pasien</label>
                <select name="patient_id" id="patient_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="">-- Pilih Pasien --</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
                @error('patient_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="complaint" class="block text-sm font-medium text-gray-700">Keluhan</label>
                <textarea name="complaint" id="complaint" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
                @error('complaint')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="payment" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="payment" id="payment" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="BPJS">BPJS</option>
                    <option value="tunai">Tunai</option>
                    <option value="asuransi">Asuransi</option>
                </select>
                @error('payment')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="doctor_id" class="block text-sm font-medium text-gray-700">Pilih Dokter</label>
                <select name="doctor_id" id="doctor_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="consultation_time" class="block text-sm font-medium text-gray-700">Waktu Konsultasi</label>
                <input type="datetime-local" name="consultation_time" id="consultation_time" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @error('consultation_time')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="queue_number" class="block text-sm font-medium text-gray-700">Queue Number</label>
                <input type="number" name="queue_number" id="queue_number" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Simpan Jadwal</button>
            </div>
        </div>
    </form>
</div>
@endsection
