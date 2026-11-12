# Debugging checklist (especially for Module D)

1. Read the brief; write down the **exact** expected URL, method, input names, output keys, status codes.
2. Open DevTools (`F12`) → **Console** for JS exceptions; **Network** for request URL, method, headers, payload, status and response body.
3. Confirm server is alive. `ECONNREFUSED` or failed-to-fetch typically means wrong port, server offline, or CORS.
4. `404` = route/ID. `401` = no/invalid token. `422` = invalid body/headers. `500` = PHP/backend error. `204` = no body.
5. Check JS DOM selection matches HTML IDs. Bind listeners after DOM exists (script with `defer`, or DOMContentLoaded).
6. Check `response.ok` and parse JSON only when response has a body.
7. Laravel: `php artisan route:list --path=api`, `php artisan optimize:clear`, `php artisan serve`.
8. MySQL: inspect real schema, never invent table names. SQL `ingredients` may be multiline columns instead of separate tables.
9. Security: `textContent` for data, don't display passwords or tokens, don't trust user-supplied user_id.
10. Test a happy path AND one negative path for every feature, with exact HTTP codes.

## Half-hour debugging plan (practice)
- 0–5 min: reproduce bug; console/network or Laravel logs.
- 5–20 min: fix critical issue(s), smallest changes possible.
- 20–27 min: run positive and negative tests.
- 27–30 min: verify no regressions; save/submit.

## Prior-day lessons
The actual Module A submission struggled with route syntax, class spelling, variable names, database column mismatches and untested flows. The actual Module B submission struggled with imports, incorrect table assumptions, API response wrappers and auth ownership. First make **one working route and response**, then move on.
