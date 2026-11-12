<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
Route::get('/recipes', [RecipeController::class, 'index']);
