@if (session('success'))
    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg" role="alert">
        <span class="font-medium">Sukses!</span> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg" role="alert">
        <span class="font-medium">Kesalahan!</span> {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg" role="alert">
        <span class="font-medium">Kesalahan Validasi!</span> Silakan periksa input Anda:
        <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif