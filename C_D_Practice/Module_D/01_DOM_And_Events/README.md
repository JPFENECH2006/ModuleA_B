# Module D — DOM And Events

**Scenario:** A recipe search form throws an exception and refreshes rather than showing results.

## Instructions

1. Start `node Shared_Mock_API/server.js` in the ZIP root.
2. Open `broken/index.html`; reproduce the error. Use DevTools Console and Network.
3. Correct the file(s), then compare against `solution/`.
4. Explain the root cause and test the fixed flow.

## Expected debugging findings (spoilers)
- `#search-form` does not match HTML `#searchForm`, so `.addEventListener` is called on null.
- `input.text` should be `input.value`.
- `#result` should be `#results`.
- `event.preventDefault()` stops unintended form navigation.
- Prefer DOM `textContent` over untrusted `innerHTML`.

The bugs are **intentional**; do not submit `broken/` as working code.
