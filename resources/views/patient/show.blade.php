@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white p-6 w-full md:w-[40%] rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Detail Pasien</h1>
                <a href="{{ route('patient.index') }}" class="p-2 bg-gray-100 flex rounded-full">
                    <i class="bx bx-x"></i>
                </a>
            </div>
            <div class="flex justify-between items-center border-b border-text/20 pb-3 mb-4">
                <div>
                    <h2 class="text-xl font-semibold">{{ $patient->name }}</h2>
                    <h3 class="text-base font-medium opacity-80">{{ $patient->email }}</h3>
                </div>
            </div>
            <div class="flex flex-col gap-3 pb-3 border-b border-text/20 mb-8">
                <div class="flex justify-between items-center">
                    <p class="text-base font-semibold">Nomor Telepon</p>
                    <span>{{ $patient->number }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-base font-semibold">Tanggal Registrasi</p>
                    <span>{{ $patient->created_at->format('d M, Y') }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('patient.edit', $patient) }}" class="px-4 py-1 border-2 rounded-lg text-primary font-medium border-primary">Edit</a>
                <form action="{{ route('patient.destroy', $patient) }}" method="POST" >
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
