<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Role;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function AdminLogin(){
        return view('admins.login');
    }

    public function getPermissionsArray(): array
    {
        return $this->permissionsArray;
    }


    public function Dashboard()
    {
        $users = Admin::count() + User::count();

        $widget = [
            'Users' => $users,
        ];
        return view('admins.home', compact('widget'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return back()->with('error', 'Invalid credentials.');
        }
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function index()
    {
        $users = Admin::paginate(5);
        if (!in_array('View Users admins', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('admins.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        if (!in_array('add admin', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if (!in_array('add admin', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = Carbon::now();

        $user =Admin::create($data);
        if ($request->filled('role')) {
            $user->assignRole($request->role);
        }

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = Admin::findOrFail($id);
        if (!in_array('View Users admins', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('admins.show', compact('user'));
    }

    public function edit($id)
    {
        $user = Admin::findOrFail($id);
        $roles = Role::all();
        if (!in_array('edit admin', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('admins.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        if (!in_array('edit admin', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $user = Admin::findOrFail($id);
        $data = $request->only(['name', 'email']);
        $data['updated_at'] = Carbon::now();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->filled('role')) {
            $role = Role::where('id', $request->role)->orWhere('name', $request->role)->first();

            if ($role) {
                $user->syncRoles($role);
            } else {
                return back()->withErrors(['role' => 'The selected role does not exist.']);
            }
        }

        $user->update($data);
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        if (!in_array('delete admin', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $user = Admin::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    public function AdminRegister()
    {
        return view('admins.register');
    }

    public function AdminRegisterCreate(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = Carbon::now();

        Admin::create($data);

        return redirect()->route('admin_login')->with('success', 'Admin created successfully.');
    }
}
