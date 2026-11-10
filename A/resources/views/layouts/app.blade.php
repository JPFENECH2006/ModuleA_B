<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EventManager</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="{{ route('events.index') }}">EventManager</a></div></nav>
<main class="container py-4">
  @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
  @yield('content')
</main>
</body></html>
