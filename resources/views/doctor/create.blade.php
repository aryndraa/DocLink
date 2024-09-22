@extends('layouts.app')

@section('content')
    <x-alert></x-alert>
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white p-6 w-[40%] rounded-xl">
            <h1 class="text-2xl font-bold mb-4">Daftarkan Dokter Baru</h1>

            {{-- Form Pendaftaran Dokter Baru --}}
            <form action="{{ route('doctor.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium ">Nama Dokter</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 p-2 block w-full border-text border rounded-lg">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium ">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 p-2 block w-full border-text border rounded-lg">
                </div>

                <div class="mb-4">
                    <label for="number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="number" id="number" value="{{ old('number') }}" required
                        class="mt-1 p-2 block w-full border-text border rounded-lg">
                </div>

                <div class="mb-4">
                    <label for="specialist_id" class="block text-sm font-medium text-gray-700">Spesialis</label>
                    <select name="specialist_id" id="specialist_id" required
                        class="mt-1 p-2 block w-full border-text border rounded-lg">
                        @foreach ($specialists as $specialist)
                            <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-12">
                    <div class="flex justify-between items-center cursor-pointer border-text border   p-2 rounded-lg" onclick="toggleAccordion()">
                        <h3 class="text-base font-medium">Pilih Hari Kerja</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" id="accordion-icon" class="h-6 w-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                
                    <div id="accordion-content" class="hidden mt-3 p-4 rounded-xl bg-gray-50">
                        <div class="flex flex-col ">
                            @php
                                $daysOfWeek = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                            @endphp
                            @foreach($daysOfWeek as $day)
                            <label class="cursor-pointer pb-2 {{ !$loop->last ? 'border-b border-gray-500' : '' }}">
                                <input type="checkbox" name="working_days[]" value="{{ $day }}" class="form-checkbox text-primary rounded focus:ring-primary">
                                <span class="ml-2 text-base font-medium">{{ ucfirst($day) }}</span>
                            </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('doctor.index') }}" class="px-4 py-2 border-2 font-semibold  border-text rounded-xl">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-primary border-2 border-primary text-white rounded-lg">Simpan</button>
                    </div>
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
