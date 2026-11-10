<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

// B1 + B6 - LIST AND FILTER
Route::get('/tickets', [TicketController::class, 'index']);

// B2 - SHOW ONE TICKET
Route::get('/tickets/{ticket}', [TicketController::class, 'show']);

// B3 - CREATE TICKET
Route::post('/tickets', [TicketController::class, 'store']);

// B4 - UPDATE TICKET
Route::put('/tickets/{ticket}', [TicketController::class, 'update']);
Route::patch('/tickets/{ticket}', [TicketController::class, 'update']);

// B5 - DELETE TICKET
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
