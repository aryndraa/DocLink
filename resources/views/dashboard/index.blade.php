@extends('layouts.app')

@section('content')


    {{-- data consultant / week --}}
    <div class="bg-white p-4  md:px-7 md:py-6 rounded-xl mb-5">

        {{-- header Card --}}
        <div class="flex  justify-between items-center mb-7">
            <div class="flex items-center gap-3">
                <span class="p-2 flex text-xl md:text-4xl rounded-xl text-white bg-primary"><i class='bx bx-user' ></i></span>
                <div >
                    <h2 class="text-lg md:text-2xl font-bold">Jumlah Pasien</h2>
                    <p class="text-xs md:text-sm">Jumlah Pasien Minggu Terakhir</p>
                </div>
            </div>
            <div class="flex md:items-end flex-col">
                <h2 class="text-base md:text-4xl text-primary md:text-text p-2 py-3 md:p-0 border md:border-none border-primary rounded-full font-extrabold">{{ $totalPatientsPerWeeks }}</h2>
                <p class="text-xs md:text-sm hidden md:block ">Total Pasien Minggu Ini</p>
            </div>
        </div>

        {{-- Cart --}}
        <canvas id="consultationChart" class="min-w-full max-h-full md:max-h-[200px]"></canvas>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="flex flex-col gap-5">
            {{-- Total Today Consultant --}}
            <div class="bg-primary px-4 md:px-6  py-3 md:py-5 text-white flex items-center justify-between rounded-xl">
                <div>
                    <h3 class="text-base font-medium">Total Antrean</h3>
                    <h1 class="text-4xl font-semibold">{{ $totalPatientToday }}</h1>
                </div>
                <span class="text-3xl bg-white flex p-3 text-primary rounded-full">
                    <i class='bx bx-group'></i>
                </span>
            </div>

            {{-- Doctor Active --}}
            <div class="p-5 md:px-6 md:py-3 bg-white rounded-xl">
                <div class="flex justify-between items-center  mb-4">
                    <h2 class="text-xl font-bold">Dokter Aktif</h2>
                    <img src="{{ asset('assets/mdi_account-online-outline.svg') }}" alt="">
                </div>
                <ul class="flex flex-col gap-3">
                    @foreach ($activeDoctor as $doctor)
                        <li class="flex justify-between items-center pb-2 {{ !$loop->last ? 'border-b border-gray-300' : '' }}">
                            <h2 class="text-base font-semibold">{{ $doctor->name }}</h2>
                            <h3 class="text-sm ">{{ $doctor->specialist->name }}</h3>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

          {{-- Schedule Today --}}
          <div class="p-5 md:px-6 md:py-3 bg-white rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <div>   
                    <h2 class="text-xl font-bold mb-2">Konsultasi Hari Ini</h2>
                    <p class="text-xs font-medium text-primary bg-primaryContent px-3 py-1 rounded-xl">jadwal Pertemuan Pasien Hari Ini</p>
                </div>
                <span class="text-3xl text-primary font-bold">{{ $totalPatientToday }}</span>
            </div>
            <ul class="flex flex-col gap-3">
                @foreach ($scheduleToday as $schedule )
                    <li class=" pb-2 {{ !$loop->last ? 'border-b border-gray-300' : '' }}">
                        <h3 class="text-base font-semibold mb-1">{{ $schedule->patient ? $schedule->patient->name : "Data Pasien telah dihapus"}}</h3>
                        <p class="text-xs font-medium">{{ $schedule->doctor ? $schedule->doctor->name : 'Data Dokter telah dihapus' }}, {{ \Carbon\Carbon::parse($schedule->consultation_time)->format('H:i:s') }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Doctor Patients --}}
        <div class="p-5 md:px-6 md:py-3 bg-white rounded-xl">
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Total Ditangani</h2>
                <p class="text-xs w-fit font-medium text-primary bg-primaryContent px-3 py-1 rounded-xl">Jadwal Dokter</p>
            </div>
            <div>
                <ul class="flex flex-col gap-3">
                    @foreach ($doctorPatients as $doctor)
                        <li class="flex items-center justify-between pb-2 {{ !$loop->last ? 'border-b border-gray-300' : '' }}">
                            <div>
                                <h3 class="text-base font-semibold mb-1">{{ $doctor->name }}</h3>
                                <p class="text-xs font-medium">{{ $doctor->specialist->name }}</p>
                            </div>
                            <span class="text-2xl font-bold text-primary">{{ $doctor->schedules_count    }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
       const ctx = document.getElementById('consultationChart').getContext('2d');   

        const gradientBg = ctx.createLinearGradient(0, 0, 0, 400); // Sesuaikan tinggi canvas
        gradientBg.addColorStop(0, 'rgba(42, 94, 220, 0.4)'); 
        gradientBg.addColorStop(1, 'rgba(42, 94, 220, 0.0)'); 

        const consultationChart = new Chart(ctx, {
            type: 'line', // Mengubah tipe chart menjadi garis
            data: {
                labels: {!! json_encode($daysOfWeek) !!},
                datasets: [{
                    label: 'Jumlah Konsultasi',
                    data: {!! json_encode($consultationData) !!},
                    backgroundColor: gradientBg, 
                    borderColor: 'rgba(42, 94, 220, 1)',
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true, 
                    borderRadius: 20, 
                    pointRadius: 1, 
                    pointHoverRadius: 7, 
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        min: 0,  // Mengatur batas minimum sumbu Y
                        max: 500,
                    },
                    x: {
                        grid: {
                            display: false 
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legend jika ada
                    }
                }
            }
        });
    </script>
@endsection