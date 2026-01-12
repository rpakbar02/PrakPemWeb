<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Tickets;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Tickets $ticket)
    {
        $request->validate([
            'message' => 'required|string'
        ]);
    
        if (!Auth::user()->is_admin && $ticket->user_id !== Auth::id()) {
            abort(403);
        }
    
        Comments::create([
            'ticket_id' => $ticket->id,
            'user_id'   => Auth::id(),
            'message'   => $request->message
        ]);
    
        return back()->with('success', 'Komentar terkirim.');
    }
}
