<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Permissions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $permissions = Permission::paginate(5);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        if (!in_array('create permission', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        if (!in_array('create permission', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        Permission::create($request->validated());
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission)
    {
        if (!in_array('View Permissions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        if (!in_array('edit permission', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        if (!in_array('edit permission', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $permission->update($request->validated());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        if (!in_array('delete permission', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
