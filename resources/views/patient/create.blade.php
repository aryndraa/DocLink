@extends('layouts.app')

@section('content')
    <x-alert></x-alert>
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white p-6 w-[40%] rounded-xl">
            <h1 class="text-2xl font-bold mb-4">Daftarkan Pasien Baru</h1>

            {{-- Form Pendaftaran Pasien Baru --}}
            <form action="{{ route('patient.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium ">Nama Pasien</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 p-2 block w-full border-text border rounded-lg">
                </div>

                <div class="mb-4">
                    <label for="number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="number" id="number" value="{{ old('number') }}" required
                        class="mt-1 p-2 block w-full border-text border rounded-lg">
                </div>

                <div class="flex justify-end">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('patient.index') }}" class="px-4 py-2 border-2 font-semibold  border-text rounded-xl">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-primary border-2 border-primary text-white rounded-lg">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
