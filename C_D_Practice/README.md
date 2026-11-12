# MaltaSkills 2026 — Modules C & D: eight recipe-themed practice scenarios

**Practice only, not confirmed competition tasks.** Based on the themes observed in the real Module A (server-rendered recipe website) and real Module B (recipe JSON API). The real Module C and D specifications for 12 November were **not supplied**. Do **not** assume their endpoints, field names, frameworks, or marking criteria will match these exercises.

## What's included

| Folder | Scenario | Purpose |
| --- | --- | --- |
| `Module_C/01_Recipe_Browser_Pagination` | Recipe list, pages & details | GET JSON, correct `{data,page,total}` wrapper |
| `Module_C/02_Login_And_Favourites` | Login, list/add/delete favourites | POST JSON, token, Authorization header, status codes |
| `Module_C/03_Search_Filter_Dashboard` | Search and filter recipes | Frontend state, combining conditions, empty states |
| `Module_C/04_Booking_Form_API` | Cooking class form calling a JSON API | Validation, async submit, form errors (hypothetical API) |
| `Module_D/01_DOM_And_Events` | Broken DOM selectors, event binding | Debug JavaScript |
| `Module_D/02_Pagination_And_JSON` | Broken JSON wrapper and page offsets | Debug data and pagination |
| `Module_D/03_Auth_And_Favourites` | Broken bearer token and POST request | Debug network/auth |
| `Module_D/04_Forms_And_Errors` | Broken booking validation/form | Debug requests/422 responses |
| `Shared_Mock_API` | Local recipe API for practice | Simulates Module B plus **fictional** booking route |
| `Notes` | Quick reference, common errors, checklists | Timed exam revision |

## Fast start on Windows

1. Install Node.js if needed. The mock server uses **only built-in Node.js modules** (no npm install).
2. In a terminal at this ZIP's extracted root:
   ```powershell
   node Shared_Mock_API/server.js
   ```
3. Open one of the `Module_C/xx.../index.html` files in your browser. If browser file restrictions apply, serve its folder with VS Code Live Server. The mock server permits CORS from local development origins.
4. Module D: first inspect `broken/`, try to fix it yourself, then compare with `solution/`.
5. The demo mock login credentials are **`demo@example.com` / `demo1234`**. Never use competition or real passwords in committed examples.

## Use with your real starter

The actual Module B contract used `/api/recipes`, `/api/recipes/{id}`, `/api/login`, and `/api/favourites`; recipe list responses use `{data,page,total}`. `Authorization: Bearer <token>` is required for favourites. Change `API_BASE` in each `app.js` to match the running server address. If a real API differs, follow **the actual brief**, not these templates.

**Do not upload an `.env`, passwords, an actual database, or tokens to GitHub.** Only use these references during the event if the organisers explicitly permit them.

**Bonus:** `Module_D/Bonus_Laravel_Routes_And_Database` contains additional PHP/Laravel debugging snippets; this is not counted as one of the four full Module D scenarios.
