<?php
namespace App\Http\Controllers;
use App\Models\Recipe;
class RecipeController extends Controller {
 public function index() {
   $recipies = Recipe::all();
   return view('recipes.index', ['recipes' => $recipes]);
 }
 public function show($id) {
   return Recipe::table('ingredients')->where('recipe_id', $id)->get();
 }
}
