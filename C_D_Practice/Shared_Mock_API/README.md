# Local development mock API (Node.js only)

Run from any directory:

```powershell
node Shared_Mock_API/server.js
```

It listens on `http://127.0.0.1:8001`. The sample credentials are `demo@example.com` and `demo1234`. Data lives in memory and resets when Node stops.

This is a toy server to test frontend behaviours, **not a secure production backend**. Password handling is intentionally simplified and differs from the official Laravel bcrypt requirement. Do not submit it as Module B.

Routes: GET `/api/recipes?page=1`, GET `/api/recipes/4`, POST `/api/login`, GET/POST `/api/favourites`, DELETE `/api/favourites/4`, plus fictional practice-only POST `/api/bookings`.
