# C3 — Search, cuisine filter, sorting, empty state

This is a **frontend-only filtering approach**. The official Module B recipe endpoint supports pagination, not search/cuisine query parameters. Therefore this scenario **fetches all pages** and filters the loaded recipes locally. Test `Maltese`, search `past`, combined query, impossible query (clear empty state), all three sorting modes and reset. For large datasets, server-side filtering would be better if the actual API supports it.
