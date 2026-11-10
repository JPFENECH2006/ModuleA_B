
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">Edit Event</h1>

    <div class="card">
        <div class="card-header">
            Edit Event Details
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('events.update', $event->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- TITLE -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $event->title) }}"
                           maxlength="255"
                           required>
                </div>

                <!-- VENUE -->
                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input type="text"
                           id="venue"
                           name="venue"
                           class="form-control"
                           value="{{ old('venue', $event->venue) }}"
                           required>
                </div>

                <!-- EVENT DATE -->
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date"
                           id="event_date"
                           name="event_date"
                           class="form-control"
                           value="{{ old('event_date', substr((string) $event->event_date, 0, 10)) }}"
                           required>
                </div>

                <!-- CATEGORY -->
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category"
                            name="category"
                            class="form-control"
                            required>

                        <option value="">Select Category</option>

                        <option value="Conference"
                            {{ old('category', $event->category) == 'Conference' ? 'selected' : '' }}>
                            Conference
                        </option>

                        <option value="Workshop"
                            {{ old('category', $event->category) == 'Workshop' ? 'selected' : '' }}>
                            Workshop
                        </option>

                        <option value="Concert"
                            {{ old('category', $event->category) == 'Concert' ? 'selected' : '' }}>
                            Concert
                        </option>
                    </select>
                </div>

                <!-- CAPACITY -->
                <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input type="number"
                           id="capacity"
                           name="capacity"
                           class="form-control"
                           value="{{ old('capacity', $event->capacity) }}"
                           min="1"
                           step="1"
                           required>
                </div>

                <!-- STATUS -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status"
                            name="status"
                            class="form-control"
                            required>

                        <option value="">Select Status</option>

                        <option value="Upcoming"
                            {{ old('status', $event->status) == 'Upcoming' ? 'selected' : '' }}>
                            Upcoming
                        </option>

                        <option value="Cancelled"
                            {{ old('status', $event->status) == 'Cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                        <option value="Completed"
                            {{ old('status', $event->status) == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

                <!-- DESCRIPTION -->
                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea id="description"
                              name="description"
                              class="form-control"
                              rows="4">{{ old('description', $event->description) }}</textarea>
                </div>

                <!-- CURRENT IMAGE -->
                <div class="form-group">
                    <label>Current Image</label>

                    <div>
                        @if ($event->image)
                            <img
                                src="{{ str_starts_with($event->image, 'events/')
                                    ? asset('storage/' . $event->image)
                                    : asset('images/' . $event->image) }}"
                                alt="{{ $event->title }}"
                                class="img-thumbnail mb-2"
                                style="width: 250px; height: 160px; object-fit: cover;">
                        @else
                            <p class="text-muted">No image uploaded.</p>
                        @endif
                    </div>
                </div>

                <!-- UPLOAD NEW IMAGE -->
                <div class="form-group">
                    <label for="image">Upload New Image</label>

                    <input type="file"
                           id="image"
                           name="image"
                           class="form-control-file"
                           accept="image/jpeg,image/png,image/webp">

                    <small class="form-text text-muted">
                        Leave empty to keep the current image.
                        Maximum size: 2 MB.
                    </small>
                </div>

                <!-- BUTTONS -->
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>

                <a href="{{ route('events.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
