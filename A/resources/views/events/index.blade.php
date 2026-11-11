
@extends('layouts.app')

@section('content')

<div class="mb-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Events</h1>

        <a href="{{ route('events.create') }}" class="btn btn-primary">
            Add Event
        </a>
    </div>
    
    <form action="{{ route('events.index') }}" method="GET" class="mb-4">

        <div class="row">

            <!-- SEARCH -->
            <div class="col-md-4 mb-2">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by title..."
                    value="{{ request('search') }}"
                >
            </div>

            <!-- CATEGORY FILTER -->
            <div class="col-md-3 mb-2">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>

                    <option value="Conference"
                        {{ request('category') == 'Conference' ? 'selected' : '' }}>
                        Conference
                    </option>

                    <option value="Workshop"
                        {{ request('category') == 'Workshop' ? 'selected' : '' }}>
                        Workshop
                    </option>

                    <option value="Concert"
                        {{ request('category') == 'Concert' ? 'selected' : '' }}>
                        Concert
                    </option>
                </select>
            </div>

            <!-- STATUS FILTER -->
            <div class="col-md-3 mb-2">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>

                    <option value="Upcoming"
                        {{ request('status') == 'Upcoming' ? 'selected' : '' }}>
                        Upcoming
                    </option>

                    <option value="Cancelled"
                        {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                    <option value="Completed"
                        {{ request('status') == 'Completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
            </div>

            <!-- FILTER BUTTON -->
            <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-primary w-100">
                    Filter
                </button>
            </div>

        </div>

        <a href="{{ route('events.index') }}" class="btn btn-secondary btn-sm">
            Clear Filters
        </a>

</form>



    <!-- EVENTS TABLE -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">

            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <!-- IMAGE -->
                        <td>
                            @if ($event->image)
                                <img
                                    src="{{ str_starts_with($event->image, 'events/')
                                        ? asset('storage/' . $event->image)
                                        : asset('images/' . $event->image) }}"
                                    alt="{{ $event->title }}"
                                    class="img-thumbnail"
                                    style="width: 110px; height: 75px; object-fit: cover;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ $event->title }}</td>
                        <td>{{ $event->venue }}</td>
                        <td>{{ substr((string) $event->event_date, 0, 10) }}</td>
                        <td>{{ $event->category }}</td>
                        <td>{{ $event->capacity }}</td>
                        <td>{{ $event->status }}</td>

                        <!-- ACTIONS -->
                        <td>
                            <a href="{{ route('events.show', $event->id) }}"
                               class="btn btn-primary btn-sm mb-1">
                                Show
                            </a>

                            <a href="{{ route('events.edit', $event->id) }}"
                               class="btn btn-warning btn-sm mb-1">
                                Edit
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm mb-1"
                                        onclick="return confirm('Are you sure you want to delete this event?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            No Events Found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
