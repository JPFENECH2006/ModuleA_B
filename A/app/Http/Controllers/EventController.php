<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // A1 - DISPLAY EVENTS and Search
 
public function index(Request $request)
{
    $query = Event::query();

    // SEARCH BY TITLE
    if ($request->filled('search')) {
        $search = strtolower($request->input('search'));

        $query->whereRaw(
            'LOWER(title) LIKE ?',
            ['%' . $search . '%']
        );
    }

    // FILTER BY CATEGORY
    if ($request->filled('category')) {
        $query->where('category', $request->input('category'));
    }

    // FILTER BY STATUS
    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    $events = $query->orderBy('event_date', 'asc')->get();

    return view('events.index', compact('events'));
}


    // A3 - SHOW CREATE FORM
    public function create()
    {
        return view('events.create');
    }

    // A3 - SAVE NEW EVENT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'category' => 'required|in:Conference,Workshop,Concert',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Upcoming,Cancelled,Completed',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('events', 'public');
        }

        Event::create($validated);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    // A2 - SHOW EVENT DETAILS
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // A4 - SHOW EDIT FORM
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // A4 - UPDATE EVENT
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'category' => 'required|in:Conference,Workshop,Concert',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Upcoming,Cancelled,Completed',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $oldImage = $event->image;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('events', 'public');
        } else {
            unset($validated['image']);
        }

        $event->update($validated);

        // Delete only old uploaded images, not starter assets.
        if (
            $request->hasFile('image') &&
            $oldImage &&
            str_starts_with($oldImage, 'events/')
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    // A5 - DELETE EVENT
    public function destroy(Event $event)
    {
        $image = $event->image;

        $event->delete();

        // Remove an uploaded file after its event is deleted.
        // Keep shared starter images untouched.
        if ($image && str_starts_with($image, 'events/')) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }
}
