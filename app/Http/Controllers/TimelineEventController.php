<?php

namespace App\Http\Controllers;

use App\Models\TimelineEvent;
use App\Http\Requests\StoreTimelineEventRequest;
use App\Http\Requests\UpdateTimelineEventRequest;

class TimelineEventController extends Controller
{
    public function index()
    {
        $timelineEvents = TimelineEvent::paginate(5);
        return view('timeline-events.index', compact('timelineEvents'));
    }

    public function create()
    {
        return view('timeline-events.create');
    }

    public function store(StoreTimelineEventRequest $request)
    {
        $data = $request->only(['title', 'subheading', 'start_date', 'end_date']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('timeline_images', 'public');  // Save to the public disk
        }

        TimelineEvent::create($data);

        return redirect()->route('timeline-events.index')->with('success', 'Timeline event created successfully!');
    }


    public function show(TimelineEvent $timelineEvent)
    {
        return view('timeline-events.show', compact('timelineEvent'));
    }

    public function edit(TimelineEvent $timelineEvent)
    {
        return view('timeline-events.edit', compact('timelineEvent'));
    }

    public function update(UpdateTimelineEventRequest $request, TimelineEvent $timelineEvent)
    {
        $data = $request->only(['title', 'subheading', 'start_date', 'end_date']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($timelineEvent->image) {
                \Storage::disk('public')->delete($timelineEvent->image);
            }
            $data['image'] = $request->file('image')->store('timeline_images', 'public');
        }

        $timelineEvent->update($data);

        return redirect()->route('timeline-events.index')->with('success', 'Timeline event updated successfully!');
    }


    public function destroy(TimelineEvent $timelineEvent)
    {
        if ($timelineEvent->image) {
            \Storage::disk('public')->delete(str_replace('/storage/', '', $timelineEvent->image));
        }

        $timelineEvent->delete();

        return redirect()->route('timeline-events.index')->with('success', 'Timeline event deleted successfully!');
    }
}
