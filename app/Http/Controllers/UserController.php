<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
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
        $user=User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
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
        $user=User::findOrFail($id);
        if ($user->image) {
            \Storage::disk('public')->delete($user->image);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
