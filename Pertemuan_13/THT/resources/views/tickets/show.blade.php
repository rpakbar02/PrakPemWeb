@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $ticket->title }}</h1>
                    <span class="px-3 py-1 text-sm font-bold rounded-full 
                        {{ $ticket->status == 'pending' ? 'bg-red-100 text-red-800' : 
                          ($ticket->status == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </div>
                
                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <span class="mr-4 bg-gray-100 px-2 py-1 rounded">Divisi: {{ $ticket->category->name }}</span>
                    <span>Lokasi: {{ $ticket->location }}</span>
                </div>

                <div class="prose max-w-none text-gray-700 mb-6">
                    <p>{{ $ticket->description }}</p>
                </div>

                @if($ticket->image_path)
                    <div class="mt-4 border rounded p-2 bg-gray-50">
                        <p class="text-xs text-gray-500 mb-2 font-bold">Bukti Foto:</p>
                        <img src="{{ asset('storage/' . $ticket->image_path) }}" class="rounded-lg shadow-sm max-h-96 w-full object-cover" alt="Bukti Foto">
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Diskusi & Tanggapan</h3>
            
            <div class="space-y-4 mb-6">
                @forelse($ticket->comments as $comment)
                    <div class="flex space-x-3 {{ $comment->user->is_admin ? 'flex-row-reverse space-x-reverse' : '' }}">
                        <div class="flex-1 {{ $comment->user->is_admin ? 'text-right' : '' }}">
                            <div class="bg-gray-50 p-3 rounded-lg border {{ $comment->user->is_admin ? 'border-blue-200 bg-blue-50' : 'border-gray-200' }}">
                                <div class="flex justify-between items-center mb-1 {{ $comment->user->is_admin ? 'flex-row-reverse' : '' }}">
                                    <strong class="text-sm {{ $comment->user->is_admin ? 'text-blue-700' : 'text-gray-800' }}">
                                        {{ $comment->user->name }}
                                        @if($comment->user->is_admin) <span class="text-xs bg-blue-600 text-white px-1 rounded ml-1">Admin</span> @endif
                                    </strong>
                                    <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 text-sm">{{ $comment->message }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm text-center italic">Belum ada tanggapan.</p>
                @endforelse
            </div>

            <form action="{{ route('tickets.comments.store', $ticket->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="flex gap-2">
                    <input type="text" name="message" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 border" placeholder="Tulis balasan..." required>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <div class="space-y-6">
        @if(auth()->user()->is_admin)
        <div class="bg-white rounded-lg shadow-md border-t-4 border-blue-600 p-6">
            <h3 class="font-bold text-gray-800 mb-3">Panel Kontrol Admin</h3>
            <form action="{{ route('tickets.update.status', $ticket->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <label class="block text-sm text-gray-600 mb-1">Update Status Tiket</label>
                <select name="status" class="w-full mb-3 rounded-md border-gray-300 shadow-sm px-3 py-2 border focus:ring focus:ring-blue-200">
                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress (Dikerjakan)</option>
                    <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved (Selesai)</option>
                </select>
                <button class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition">
                    Simpan Perubahan
                </button>
            </form>
        </div>
        @endif

        <!-- Info Tiket -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Informasi Pelapor</h4>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="block text-gray-400">Nama Pelapor:</span>
                    <span class="text-gray-800 font-medium">{{ $ticket->user->name }}</span>
                </div>
                <div>
                    <span class="block text-gray-400">Email:</span>
                    <span class="text-gray-800">{{ $ticket->user->email }}</span>
                </div>
                <div>
                    <span class="block text-gray-400">Tanggal Laporan:</span>
                    <span class="text-gray-800">{{ $ticket->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection