# Module D — Pagination And JSON

**Scenario:** Page number and response format mishandled; list is blank, next/previous go out of bounds.

## Instructions

1. Start `node Shared_Mock_API/server.js` in the ZIP root.
2. Open `broken/index.html`; reproduce the error. Use DevTools Console and Network.
3. Correct the file(s), then compare against `solution/`.
4. Explain the root cause and test the fixed flow.

## Expected debugging findings (spoilers)
- Page begins at 1 rather than 0.
- JSON response is an object `{data,page,total}`, so iterate `payload.data`, not `payload`.
- `total` is all recipes (`payload.total`), not current page count (`payload.data.length`).
- Prevent navigation beyond valid pages and check `response.ok`.

The bugs are **intentional**; do not submit `broken/` as working code.
