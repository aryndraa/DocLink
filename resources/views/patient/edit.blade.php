@extends('layouts.app')

@section('content')
    <x-alert></x-alert>
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white p-6 w-full md:w-[40%] rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Edit Pasien</h1>
                <a href="{{ route('patient.index') }}" class="p-2 bg-gray-100 flex rounded-full">
                    <i class="bx bx-x"></i>
                </a>
            </div>

            {{-- Form Edit Pasien --}}
            <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="number" id="number" value="{{ old('number', $patient->number) }}" required
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
