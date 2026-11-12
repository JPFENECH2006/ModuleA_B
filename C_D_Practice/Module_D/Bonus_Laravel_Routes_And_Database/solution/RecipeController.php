<?php
namespace App\Http\Controllers;
use App\Models\Recipe;
class RecipeController extends Controller {
 public function index() {
   $recipes = Recipe::all();
   return view('recipes.index', compact('recipes'));
 }
 public function show($id) {
   $recipe = Recipe::findOrFail($id);
   return view('recipes.show', compact('recipe'));
 }
}
