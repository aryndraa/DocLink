<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DocLink | {{ $title }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        {{-- box icon --}}
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

        {{-- tailwind --}}
        @vite('resources/css/app.css')

        {{-- font --}}
        <link rel="stylesheet" href="{{ asset('font/satoshi.css') }}">

        {{-- Cart JS --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    <body class="text-text">
        <div id="app">
            <aside class="fixed right-0 lg:right-auto left-0 lg:top-0 bottom-0 flex flex-col bg-white z-[99999999] rounded-3xl shadow-xl lg:rounded-none lg:rounded-r-lg py-4  px-8 mx-4 md:mx-12 my-5 md:my-8  lg:m-0 lg:p-8 lg:pr-12 ">
                <div class="hidden lg:flex items-center gap-3 mb-10">
                    <img src="{{ asset('assets/Logo.svg') }}" alt="">
                    <h1 class="text-3xl font-bold ">DocLink</h1>
                </div>
                <div class="flex flex-row justify-between lg:flex-col lg:gap-6">
                    <a href="{{ route('dashboard') }}" 
                       class="text-lg font-bold flex items-center gap-3 lg:border-b-2 pb-0 lg:pb-3 
                              {{ request()->routeIs('dashboard') ? 'text-primary border-primary' : 'text-gray-400 border-transparent' }}">
                        @if (request()->routeIs('dashboard'))
                            <img src="{{ asset('assets/dashboard2.svg') }}" alt="icon">
                        @else
                            <img src="{{ asset('assets/dashboard.svg') }}" alt="icon" class="opacity-40">
                        @endif
                        <span class="hidden md:block">Dashboard</span>
                    </a>

                    <a href="{{ route('patient.index') }}" 
                    class="text-lg font-bold flex items-center gap-3 lg:border-b-2 pb-0 lg:pb-3 
                           {{ request()->routeIs('patient.index') ? 'text-blue-500 border-primary' : 'text-gray-400 border-transparent' }}">
                         @if (request()->routeIs('patient'))
                           <img src="{{ asset('assets/riwayat2.svg') }}" alt="icon">
                         @else
                           <img src="{{ asset('assets/riwayat.svg') }}" alt="icon" class="opacity-40">
                         @endif
                         <span class="hidden md:block">Riwayat</span>
                    </a>
                    
                    <a href="{{ route('schedule.index') }}" 
                       class="text-lg font-bold flex items-center gap-3 lg:border-b-2 pb-0 lg:pb-3 
                              {{ request()->routeIs('schedule.index') ? 'text-blue-500 border-primary' : 'text-gray-400 border-transparent' }}">
                        @if (request()->routeIs('schedule.index'))
                              <img src="{{ asset('assets/jadwal2.svg') }}" alt="icon">
                        @else
                              <img src="{{ asset('assets/jadwal.svg') }}" alt="icon" class="opacity-40">
                        @endif
                        <span class="hidden md:block">Jadwal Konsultasi</span>
                    </a>
                    
                    <a href="{{ route('doctor.index') }}" 
                       class="text-lg font-bold flex items-center gap-3 lg:border-b-2 pb-0 lg:pb-3 
                              {{ request()->routeIs('doctor.index') ? 'text-blue-500 border-primary' : 'text-gray-400 border-transparent' }}">
                        @if (request()->routeIs('doctor.index'))
                          <img src="{{ asset('assets/dokter2.svg') }}" alt="icon">
                        @else
                          <img src="{{ asset('assets/dokter.svg') }}" alt="icon" class="opacity-40">
                        @endif
                        <span class="hidden md:block">Dokter</span>                    
                    </a>
                    
                   
                </div>
            </aside>

            
            <main class="p-4 md:px-12 py-4 pd:my-10 lg:p-6 lg:pl-72 ">
                <header class="mb-7">
                    <div class="flex items-center gap-5">
                        <h1 class="text-2xl md:text-3xl font-bold capitalize">{{ $title }}</h1>
                        <div class="hidden lg:flex flex-col text-sm text-neutral-500">
                            <p><span id="current-time"></span></p>
                            <p><span id="current-date"></span></p>
                        </div>
                    </div>
                </header>
                    @yield('content')
            </main>
        </div>

       
        <script>
            function updateDateTime() {
                const now = new Date();

                const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', timeZone: 'Asia/Makassar' };
                document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', optionsDate);

                const optionsTime = { hour: '2-digit', minute: '2-digit', hour12: true, timeZone: 'Asia/Makassar' };
                document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', optionsTime);
            }

            setInterval(updateDateTime, 1000);
            updateDateTime();
        </script>
    </body>
</html>
