<?php
// LEARNING REFERENCE — snippets for routes/controllers, NOT a single runnable PHP file.
// Confirm real database columns and brief before using.

// Route patterns (routes/api.php):
// Route::get('/recipes', [RecipeApiController::class, 'index']);
// Route::get('/recipes/{id}', [RecipeApiController::class, 'show']);
// Route::post('/login', [RecipeApiController::class, 'login']);
// Route::get('/favourites', [RecipeApiController::class, 'favourites']);
// Route::post('/favourites', [RecipeApiController::class, 'addFavourite']);
// Route::delete('/favourites/{recipe_id}', [RecipeApiController::class, 'removeFavourite']);

// Validation pattern:
// $validated = $request->validate(['email'=>'required|email','password'=>'required|string']);
// Laravel should render JSON for /api/* errors; configure bootstrap/app.php ->withExceptions.

// Query builder patterns:
// DB::table('recipes')->orderBy('id')->offset(($page-1)*10)->limit(10)->get();
// DB::table('recipes')->where('id', $id)->first();
// DB::table('favourites')->where('user_id', $userId)->where('recipe_id', $recipeId)->delete();

// Password and tokens:
// Hash::check($enteredPassword, $user->password); // bcrypt hash verification
// bin2hex(random_bytes(32)); // secure random 64 hex chars

// Response status:
// response()->json(['data'=>$data,'page'=>$page,'total'=>$total], 200);
// response()->json(['token'=>$token],200);
// response()->json($recipe,201);
// response()->json(['message'=>'Not found'],404);
// response()->noContent(); // 204, body must be empty
