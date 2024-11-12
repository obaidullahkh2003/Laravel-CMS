<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!in_array('View Users users', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $users = User::paginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!in_array('add user', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if (!in_array('add user', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['name', 'email', 'address', 'phone']);
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $user = User::create($data);
        if ($request->filled('role')) {
            $user->assignRole($request->role);
        }

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!in_array('View Users users', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $user=User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!in_array('edit user', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (!in_array('edit user', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email', 'address', 'phone']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            if ($user->image) {
                \Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $user->update($data);
        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!in_array('delete users', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $user=User::findOrFail($id);
        if ($user->image) {
            \Storage::disk('public')->delete($user->image);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

}
