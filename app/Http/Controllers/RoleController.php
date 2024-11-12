<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Roles', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        if (!in_array('create role', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        if (!in_array('create role', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $role = Role::create($request->only('name'));

        if ($request->has('permissions')) {
            $role->permissions()->attach($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        if (!in_array('View Roles', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        if (!in_array('edit role', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $permissions = Permission::all();
        $selectedPermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'selectedPermissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        if (!in_array('edit role', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $role->update($request->validated());

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if (!in_array('delete role', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
