<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTicketRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Ticketcontroller extends Controller
{
    public function create() {
        return view('ticket_form');
    }

    public function store(StoreTicketRequest $request) {
      
        $validated = $request->validated();
        $type = $validated['type'];
        $connectionMap = [
            'technical' => 'technical',
            'billing' => 'billing',
            'product' => 'product',
            'general' => 'general',
            'feedback' => 'feedback',
        ];

        $conn = $connectionMap[$type] ?? 'mysql';

        DB::connection($conn)->table('tickets')->insert([
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'created_at' => now(),
        ]);

        return back()->with('success', 'Ticket submitted successfully!');
    }
}
