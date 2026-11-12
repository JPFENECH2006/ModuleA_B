# Grounded requirements vs predicted scenarios

## Confirmed by uploaded Module A brief (11 November)
- Recipe site is server-rendered; `/`, search title, cuisine filter, detail `/recipes/{id}`, book cooking class; MySQL supplied.

## Confirmed by uploaded Module B brief (11 November)
- GET `/api/recipes`, ten per page, sorted ID; `{data,page,total}`.
- GET `/api/recipes/{id}`, ingredients/method arrays.
- POST `/api/login` uses bcrypt checking and random token.
- Favourites GET/POST/DELETE protected with Bearer token; exact status code expectations.

## Unknown: real Module C / D
The files for tomorrow's Module C and Module D have not been provided. The four scenarios under each module are **illustrative exercises**, not forecasts guaranteed by the organisers. Module C is modelled as vanilla-JavaScript API frontend practice; Module D as debugging practice. A real exam can cover other tasks. Read its PDF first.

## Particularly important: C04 booking endpoint
`POST /api/bookings` is **invented only for this practice server**. It is NOT in the official Module B brief. Do not assume the actual backend exposes it.
