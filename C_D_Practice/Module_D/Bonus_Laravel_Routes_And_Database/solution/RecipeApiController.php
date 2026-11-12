<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
class RecipeApiController extends Controller {
 public function index(Request $request) {
   $page = max(1,(int)$request->query('page',1));
   $query = Recipe::query()->orderBy('id');
   $total = (clone $query)->count();
   $recipes = $query->offset(($page-1)*10)->limit(10)->get();
   $data = $recipes->map(fn($r)=>[
      'id'=>$r->id,'title'=>$r->title,'cuisine'=>$r->cuisine,
      'summary'=>$r->summary,'prep_minutes'=>(int)$r->prep_minutes,
      'cook_minutes'=>(int)$r->cook_minutes,
      'total_minutes'=>(int)$r->prep_minutes+(int)$r->cook_minutes,
      'servings'=>(int)$r->servings,'image'=>$r->image
   ]);
   return response()->json(['data'=>$data,'page'=>$page,'total'=>$total]);
 }
 public function show($id) {
   $r=Recipe::findOrFail($id);
   $lines=fn($s)=>array_values(array_filter(array_map('trim',preg_split('/\r\n|\r|\n/',(string)$s)),fn($x)=>$x!==''));
   return response()->json([
     'id'=>$r->id,'title'=>$r->title,'cuisine'=>$r->cuisine,
     'summary'=>$r->summary,'prep_minutes'=>(int)$r->prep_minutes,
     'cook_minutes'=>(int)$r->cook_minutes,
     'total_minutes'=>(int)$r->prep_minutes+(int)$r->cook_minutes,
     'servings'=>(int)$r->servings,'image'=>$r->image,
     'ingredients'=>$lines($r->ingredients),'method'=>$lines($r->method)
   ]);
 }
}
