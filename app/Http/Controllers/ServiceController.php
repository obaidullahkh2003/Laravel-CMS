<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Page Content services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $services = Service::paginate(5);
        return view('services.index', compact('services'));
    }


    public function create()
    {
        if (!in_array('create services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        if (!in_array('create services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
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
        if (!in_array('View Page Content services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        if (!in_array('edit services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        if (!in_array('edit services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
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
        if (!in_array('delete services', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        if ($service->icon) {
            \Storage::disk('public')->delete($service->icon);
        }

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
