<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(5);
        return view('services.index', compact('services'));
    }


    public function create()
    {
        return view('services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->only(['title', 'description']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }
        Service::create($data);
        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->only(['title', 'description']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('icon')) {
            if ($service->icon) {
                \Storage::disk('public')->delete($service->icon);
            }
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        if ($service->icon) {
            \Storage::disk('public')->delete($service->icon);
        }

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
