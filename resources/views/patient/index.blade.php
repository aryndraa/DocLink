@extends('layouts.app')

@section('content')
    <x-alert></x-alert>
    <div class="px-5 md:px-8 py-6 w-full bg-white rounded-xl">
        <div class="flex flex-col gap-5 mb-12 md:mb-0 md:flex-row justify-between md:items-center">
            <div class="md:mb-12">
                <h2 class="text-2xl font-bold mb-3">List Pasien</h2>
                <p class="text-base font-medium text-primary bg-primaryContent px-3 py-1 rounded-xl w-fit">List pasien beserta jadwal</p>
            </div>
            <div>
                <a href="{{ route('patient.create') }}" class="px-4 py-2 bg-primary font-semibold text-white rounded-lg">Daftarkan Pasien +</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full ">
                <thead>
                    <tr>
                        <th class="text-start text-sm text-text/50 pb-1 pl-4">Nama Pasien</th>
                        <th class="text-start text-sm text-text/50 pb-1 pl-4">Nomor Pasien</th>
                        <th class="text-start text-sm text-text/50 pb-1 pl-4">Jumlah Jadwal</th>
                        <th class="text-start text-sm text-text/50 pb-1 pl-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr class="{{ !$loop->last ? 'border-b border-gray-200' : '' }} w-full">
                            <td class="text-base font-medium py-1 md:py-4 pl-4"><span class="md:hidden ">Nama Pasien : </span>{{ $patient->name }}</td>
                            <td class="text-base font-medium py-1 md:py-4 pl-4"><span class="md:hidden ">Nomor Pasien : </span>{{ $patient->number }}</td>
                            <td class="text-base font-medium py-1 md:py-4 pl-4"><span class="md:hidden ">Jumlah Jadwal : </span>{{ $patient->schedules_count }}</td>
                            <td class="text-base font-medium py-4 mt-4 md:mt-0 md:py-4 pl-4 flex gap-4">
                                <a href="{{ route('patient.show', $patient) }}" class="px-3 py-1 border-2 rounded-lg border-primary bg-primary text-white"> 
                                    View
                                </a>
                                <a href="{{ route('patient.edit', $patient) }}" class="px-3 py-1 border-2 rounded-lg border-primary ">
                                    Edit
                                </a>
                                <form action="{{ route('patient.destroy', $patient->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button _
                                        class="px-3 py-1 border-2 rounded-lg border-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <style>
            @media (max-width: 768px) {
                table, thead, tbody, th, td, tr {
                    display: block;
                }
                thead tr {
                    display: none; 
                }
                tr {
                    margin-bottom: 1rem; 
                }
                td {
                    text-align: left; 
                    position: relative;
                    padding-left: 50%; 
                }
                td::before {
                    content: attr(data-label); 
                    position: absolute;
                    left: 10px; 
                    text-align: left; 
                    font-weight: bold;
                }
            }
        </style>
        
    </div>
@endsection
