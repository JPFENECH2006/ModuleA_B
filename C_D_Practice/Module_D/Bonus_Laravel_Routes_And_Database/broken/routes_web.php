<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeControllerr;
Route::get()('/recipes', [RecipeControllerr::class, 'index']);
