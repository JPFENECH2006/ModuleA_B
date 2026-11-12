# Module D — Forms And Errors

**Scenario:** Booking form reloads, JSON request fails, wrong field names, no 422 feedback.

## Instructions

1. Start `node Shared_Mock_API/server.js` in the ZIP root.
2. Open `broken/index.html`; reproduce the error. Use DevTools Console and Network.
3. Correct the file(s), then compare against `solution/`.
4. Explain the root cause and test the fixed flow.

## Expected debugging findings (spoilers)
- Prevent the default HTML form submission.
- POST JSON, do not GET with a request body.
- Use the correct field name `date` rather than `class_date` (practice schema).
- Use JSON encoding and `Content-Type: application/json`.
- Display 422 validation errors beside their fields and preserve form values.
- `/api/bookings` is a fictional endpoint in this training server. 

The bugs are **intentional**; do not submit `broken/` as working code.
