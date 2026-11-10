<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::redirect('/', '/events');
Route::resource('events', EventController::class);
