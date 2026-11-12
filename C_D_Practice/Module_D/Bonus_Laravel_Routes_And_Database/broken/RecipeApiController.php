<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Recipe;
class RecipeApiController extends Controller {
 public function index() {
   return response()->json(Recipe::paginate(10));
 }
 public function show($id) {
   $r = Recipe::findOrFail($id);
   return response()->json($r);
 }
}
