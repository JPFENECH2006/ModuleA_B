<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    // B1 + B6 - LIST, SEARCH AND FILTER TICKETS
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::query();

        // Search by subject
        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));

            $query->whereRaw(
                'LOWER(subject) LIKE ?',
                ['%' . $search . '%']
            );
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where(
                'priority',
                $request->input('priority')
            );
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->input('status')
            );
        }

        $tickets = $query->get();

        return response()->json($tickets, 200);
    }

    // B2 - SHOW SINGLE TICKET
    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json($ticket, 200);
    }

    // B3 - CREATE TICKET
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'description' => 'required|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Closed',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json($ticket, 201);
    }

    // B4 - UPDATE TICKET (PUT AND PATCH)
    public function update(
        Request $request,
        Ticket $ticket
    ): JsonResponse {

        // PATCH allows partial updates.
        // PUT requires all five fields.
        $rule = $request->isMethod('patch')
            ? 'sometimes|required'
            : 'required';

        $validated = $request->validate([
            'subject' => "$rule|string|max:255",
            'customer_email' => "$rule|email",
            'description' => "$rule|string",
            'priority' => "$rule|in:Low,Medium,High",
            'status' => "$rule|in:Open,In Progress,Closed",
        ]);

        $ticket->update($validated);

        return response()->json(
            $ticket->fresh(),
            200
        );
    }

    // B5 - DELETE TICKET
    public function destroy(Ticket $ticket): Response
    {
        $ticket->delete();

        return response('', 204);
    }
}
