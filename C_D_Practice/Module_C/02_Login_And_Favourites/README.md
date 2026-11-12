# C2 — Login and favourites

Run mock API. Login with `demo@example.com` / `demo1234`. The app stores the returned token **in memory**, passes it as `Authorization: Bearer <token>` for all favourite requests, and handles a 204 DELETE without calling `.json()`. Test wrong password (401), invalid recipe ID (422), favourite deletion and empty state.

**Real backend:** Never commit credentials or tokens. Do not assume the exact login or favourite endpoints until you read Module C's actual assessment.
