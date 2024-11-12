<?php

namespace App\Http\Controllers;

use App\Models\TimelineEvent;
use App\Http\Requests\StoreTimelineEventRequest;
use App\Http\Requests\UpdateTimelineEventRequest;

class TimelineEventController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Page Content timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $timelineEvents = TimelineEvent::paginate(5);
        return view('timeline-events.index', compact('timelineEvents'));
    }

    public function create()
    {
        if (!in_array('create timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('timeline-events.create');
    }

    public function store(StoreTimelineEventRequest $request)
    {
        if (!in_array('create timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
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
        if (!in_array('View Page Content timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('timeline-events.show', compact('timelineEvent'));
    }

    public function edit(TimelineEvent $timelineEvent)
    {
        if (!in_array('edit timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('timeline-events.edit', compact('timelineEvent'));
    }

    public function update(UpdateTimelineEventRequest $request, TimelineEvent $timelineEvent)
    {
        if (!in_array('edit timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
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
        if (!in_array('delete timeline', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        if ($timelineEvent->image) {
            \Storage::disk('public')->delete(str_replace('/storage/', '', $timelineEvent->image));
        }

        $timelineEvent->delete();

        return redirect()->route('timeline-events.index')->with('success', 'Timeline event deleted successfully!');
    }
}
