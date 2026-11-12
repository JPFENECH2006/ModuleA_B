# Bonus debugging: Laravel backend, routes, imports, SQL and JSON shape

This appendix consists of **standalone sample snippets**, not a complete Laravel project. Study the bugs in `broken/`, then inspect `solution/`. The actual D task may be unrelated.

## Bugs to find
1. `Route::get()('/recipes'...)` invokes a method result as a function; correct to `Route::get('/recipes', ...)`.
2. Controller import and class name must agree, e.g. `RecipeController`.
3. `Recipe::table()` is invalid Eloquent usage. Use `Recipe::findOrFail($id)` or query builder `DB::table('recipes')`.
4. The SQL stores ingredients and method in **multiline columns**; do not assume separate tables.
5. `paginate(10)` returns Laravel's generic paginator JSON, not always the custom `data`, `page`, `total` output the official Module B specified.
6. `return view(...)` is needed for a Blade route; API endpoints must return JSON.

## Debug commands
```
php artisan route:list
php artisan route:list --path=api
php artisan optimize:clear
php artisan serve
```

Inspect `.env` and the actual SQL schema; never run `migrate:fresh` on imported competition data.
