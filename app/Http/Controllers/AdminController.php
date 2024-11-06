<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminlogin(){
        return view('admins.login');
    }

    public function Dashboard()
    {
        $users = User::count();

        $widget = [
            'admins' => $users,
            //...
        ];

        return view('admins.home', compact('widget'));
    }


    public function login(Request $request){
        $chick=$request->all();
        if (Auth::guard('admin')->attempt(['email' => $chick['email'], 'password' => $chick['password']])) {
            return redirect()->route('home');
        }else{
            return back()->with('error', 'Wrong Email or Password');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }
    public function index()
    {
        $users = Admin::paginate(5);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
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

    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(UpdateAdminRequest $request, $id)
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
