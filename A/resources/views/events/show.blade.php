
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">{{ $event->title }}</h1>

    <div class="card">

        <div class="card-header">
            Event Details
        </div>

        <div class="card-body">

            <!-- EVENT IMAGE -->
            @if ($event->image)
                <img
                    src="{{ str_starts_with($event->image, 'events/')
                        ? asset('storage/' . $event->image)
                        : asset('images/' . $event->image) }}"
                    alt="{{ $event->title }}"
                    class="img-fluid rounded mb-4"
                    style="max-width: 100%; max-height: 350px; object-fit: cover;">
            @endif

            <p><strong>Title:</strong> {{ $event->title }}</p>

            <p><strong>Venue:</strong> {{ $event->venue }}</p>

            <p>
                <strong>Date:</strong>
                {{ substr((string) $event->event_date, 0, 10) }}
            </p>

            <p><strong>Category:</strong> {{ $event->category }}</p>

            <p><strong>Capacity:</strong> {{ $event->capacity }}</p>

            <p><strong>Status:</strong> {{ $event->status }}</p>

            <p>
                <strong>Description:</strong>
                {{ $event->description ?? 'No description available.' }}
            </p>

        </div>
    </div>

    <a href="{{ route('events.index') }}"
       class="btn btn-secondary mt-3">
        Back to Events
    </a>

    <a href="{{ route('events.edit', $event->id) }}"
       class="btn btn-warning mt-3">
        Edit Event
    </a>

</div>

@endsection
