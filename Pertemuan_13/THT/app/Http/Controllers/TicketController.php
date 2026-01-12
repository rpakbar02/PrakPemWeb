<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();

        if($user -> is_admin){
            $tickets = Tickets::with(['user', 'category'])->latest()->get();
        } else {
            $tickets = Tickets::with(['category'])->where('user_id', $user->id)->latest()->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location'    => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tickets', 'public');
        }

        Tickets::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'image_path'  => $imagePath,
            'status'      => 'pending',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function show(Tickets $ticket)
    {
        $ticket->load(['comments.user', 'category']);

        if (!Auth::user()->is_admin && $ticket->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, Tickets $ticket)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved'
        ]);

        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $ticket->update(['status' => $request->status]);

        return back()->with('success', 'Status laporan diperbarui.');
    }
}
