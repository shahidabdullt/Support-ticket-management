<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function login()
    {
        try {
            return response()->view('login', [], Response::HTTP_OK);
        } catch (\Throwable $e) {
            Log::error('Error showing login form: ' . $e->getMessage(), ['exception' => $e]);
            return response('Unable to load login page', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'Email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/ticketlist', Response::HTTP_SEE_OTHER);
            }

            return back()
                ->withErrors(['Email' => 'Invalid credentials'])
                ->withInput($request->except('password'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation Exception returns 422 Unprocessable Entity
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Authentication error: ' . $e->getMessage(), ['exception' => $e]);
            return response('Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function ticketlist()
    {
        try {
            $tickets = collect();

            foreach (['technical', 'billing', 'product', 'general', 'feedback'] as $conn) {
                $rows = DB::connection($conn)
                    ->table('tickets')
                    ->select('*', DB::raw("'{$conn}' as source"))
                    ->get();
                $tickets = $tickets->merge($rows);
            }

            return response()->view('admin.tickets', compact('tickets'), Response::HTTP_OK);
        } catch (\Throwable $e) {
            Log::error('Error fetching tickets: ' . $e->getMessage(), ['exception' => $e]);
            return response('Failed to load tickets', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function viewTicket($id, $type)
    {
        try {
            $ticket = DB::connection($type)
                ->table('tickets')
                ->find($id);

            if (! $ticket) {
                return response('Ticket not found', Response::HTTP_NOT_FOUND);
            }

            return response()->view('admin.ticket_view', compact('ticket', 'type'), Response::HTTP_OK);
        } catch (\Throwable $e) {
            Log::error("Error viewing ticket ({$type}:{$id}): " . $e->getMessage(), ['exception' => $e]);
            return response('Unable to load ticket details', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addNote(Request $request, $id, $type)
    {
        try {
            $validated = $request->validate([
                'note' => 'required|string',
            ]);

            $adminnote = strip_tags($validated['note']);

            $updated = DB::connection($type)
                ->table('tickets')
                ->where('id', $id)
                ->update([
                    'admin_note' => $adminnote,
                    'status' => 'Noted',
                    'updated_at' => now(),
                ]);

            if (! $updated) {
                return response('Ticket not found or not updated', Response::HTTP_NOT_FOUND);
            }

            return redirect('/ticketlist', Response::HTTP_SEE_OTHER)
                ->with('success', 'Note added successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error("Error adding note to ticket ({$type}:{$id}): " . $e->getMessage(), ['exception' => $e]);
            return response('Failed to save note', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/admin/login', Response::HTTP_SEE_OTHER)
                ->with('success', 'Logged out successfully');
        } catch (\Throwable $e) {
            Log::error('Logout error: ' . $e->getMessage(), ['exception' => $e]);
            return response('Logout failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
