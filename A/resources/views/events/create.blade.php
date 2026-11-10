
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">Create Event</h1>

    <div class="card">
        <div class="card-header">
            Create Event Details
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

            <form action="{{ route('events.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <!-- TITLE -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
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
                           value="{{ old('venue') }}"
                           required>
                </div>

                <!-- EVENT DATE -->
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date"
                           id="event_date"
                           name="event_date"
                           class="form-control"
                           value="{{ old('event_date') }}"
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
                            {{ old('category') == 'Conference' ? 'selected' : '' }}>
                            Conference
                        </option>

                        <option value="Workshop"
                            {{ old('category') == 'Workshop' ? 'selected' : '' }}>
                            Workshop
                        </option>

                        <option value="Concert"
                            {{ old('category') == 'Concert' ? 'selected' : '' }}>
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
                           value="{{ old('capacity') }}"
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
                            {{ old('status', 'Upcoming') == 'Upcoming' ? 'selected' : '' }}>
                            Upcoming
                        </option>

                        <option value="Cancelled"
                            {{ old('status') == 'Cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                        <option value="Completed"
                            {{ old('status') == 'Completed' ? 'selected' : '' }}>
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
                              rows="4">{{ old('description') }}</textarea>
                </div>

                <!-- IMAGE UPLOAD -->
                <div class="form-group">
                    <label for="image">Event Image (Optional)</label>

                    <input type="file"
                           id="image"
                           name="image"
                           class="form-control-file"
                           accept="image/jpeg,image/png,image/webp">

                    <small class="form-text text-muted">
                        JPG, PNG or WebP. Maximum size: 2 MB.
                    </small>
                </div>

                <!-- BUTTONS -->
                <button type="submit" class="btn btn-primary">
                    Save Event
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
