# Module D — Auth And Favourites

**Scenario:** Login seems successful but protected favourites return 401 or invalid body.

## Instructions

1. Start `node Shared_Mock_API/server.js` in the ZIP root.
2. Open `broken/index.html`; reproduce the error. Use DevTools Console and Network.
3. Correct the file(s), then compare against `solution/`.
4. Explain the root cause and test the fixed flow.

## Expected debugging findings (spoilers)
- The login response has `token`, not `access_token`.
- Auth header must be `Authorization: Bearer <token>`.
- POST body must be `JSON.stringify({recipe_id: number})`.
- JSON POST requires `Content-Type: application/json`.
- A 401 or 422 does not make `fetch` throw; check status and response. 

The bugs are **intentional**; do not submit `broken/` as working code.
