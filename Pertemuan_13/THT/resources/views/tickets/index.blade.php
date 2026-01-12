@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Laporan</h1>
    <a href="{{ route('tickets.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
        + Buat Laporan Baru
    </a>
</div>

@if($tickets->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($tickets as $ticket)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden border border-gray-200">
            <div class="p-5">
                <div class="flex justify-between items-start">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $ticket->status == 'pending' ? 'bg-red-100 text-red-800' : 
                          ($ticket->status == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                        {{ strtoupper(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                    <span class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</span>
                </div>
                
                <h3 class="mt-2 text-lg font-bold text-gray-900 truncate">{{ $ticket->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($ticket->description, 80) }}</p>
                
                <div class="mt-4 flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $ticket->location }}
                </div>
            </div>

            <div class="bg-gray-50 px-5 py-3 border-t border-gray-200 flex justify-between items-center">
                <span class="text-xs font-medium text-gray-600 bg-gray-200 px-2 py-1 rounded">
                    {{ $ticket->category->name }}
                </span>
                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Lihat Detail &rarr;
                </a>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <p class="text-gray-500 text-lg">Belum ada laporan yang masuk.</p>
    </div>
@endif
@endsection