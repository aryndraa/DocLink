@extends('layouts.app')

@section('content')
    <x-alert></x-alert>
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white p-6 w-full md:w-[40%] rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold">Edit Dokter</h1>
                <a href="{{ route('doctor.index') }}" class="p-2 bg-gray-100 flex rounded-full">
                    <i class="bx bx-x"></i>
                </a>
            </div>

            {{-- Form Edit Dokter --}}
            <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}" required
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $doctor->email) }}" required
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="number" id="number" value="{{ old('number', $doctor->number) }}" required
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="specialist_id" class="block text-sm font-medium text-gray-700">Spesialis</label>
                    <select name="specialist_id" id="specialist_id" required
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach ($specialists as $specialist)
                            <option value="{{ $specialist->id }}" {{ $doctor->specialist_id == $specialist->id ? 'selected' : '' }}>
                                {{ $specialist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <!-- Title -->
                    <div class="flex justify-between items-center cursor-pointer bg-gray-200 p-3 rounded-lg" onclick="toggleAccordion()">
                        <h3 class="text-lg font-medium">Pilih Hari Kerja</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" id="accordion-icon" class="h-6 w-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                
                    <!-- Content -->
                    <div id="accordion-content" class="hidden mt-3">
                        <div class="space-y-2">
                            @php
                                $daysOfWeek = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                            @endphp
                            @foreach($daysOfWeek as $day)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="working_days[]" value="{{ $day }}" 
                                    {{ in_array($day, $workingDays) ? 'checked' : '' }} class="form-checkbox text-primary rounded focus:ring-primary">
                                <span class="ml-2 text-sm font-medium">{{ ucfirst($day) }}</span>
                            </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
                

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleAccordion() {
            const content = document.getElementById('accordion-content');
            const icon = document.getElementById('accordion-icon');
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
@endsection
