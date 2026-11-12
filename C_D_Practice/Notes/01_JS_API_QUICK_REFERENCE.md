# Vanilla JavaScript API quick reference

```js
// GET request: no body; optionally Accept header
const response = await fetch(`${API_BASE}/api/recipes?page=1`, {
  headers: { Accept: 'application/json' }
});
if (!response.ok) throw new Error(`HTTP ${response.status}`);
const result = await response.json(); // { data, page, total }

// POST JSON: include Content-Type and JSON.stringify(body)
const res = await fetch(`${API_BASE}/api/login`, {
  method: 'POST',
  headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
  body: JSON.stringify({ email, password })
});

// Protected GET (token returned by login)
const res2 = await fetch(`${API_BASE}/api/favourites`, {
  headers: { Accept: 'application/json', Authorization: `Bearer ${token}` }
});

// Protected DELETE: usually no body
await fetch(`${API_BASE}/api/favourites/4`, {
  method: 'DELETE', headers: { Authorization: `Bearer ${token}` }
});
```

Important: `fetch` does not throw for 401 / 404 / 422! Check `response.ok` or `response.status`. HTTP 204 has **no response body**; don't call `response.json()` on a 204. Beware using `innerHTML` with user/API data; prefer `textContent` and `createElement`.

## Postman choices
| Request | Authorization | Body | Status |
|--|--|--|--|
| GET recipes | No Auth | none | 200 |
| GET recipe | No Auth | none | 200 / 404 |
| POST login | No Auth | raw JSON | 200 / 401 / 422 |
| GET favourites | Bearer Token | none | 200 / 401 |
| POST favourite | Bearer Token | raw JSON `{ "recipe_id": 4 }` | 201 / 422 |
| DELETE favourite | Bearer Token | none | 204 / 404 |

Actual test values and expected response shape always come from the assessment brief.
