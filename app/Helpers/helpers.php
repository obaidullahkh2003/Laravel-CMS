<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getPermissionsArray')) {
    /**
     * Get the permissions array for the authenticated admin.
     *
     * @return array
     */
    function getPermissionsArray()
    {
        $user = Auth::guard('admin')->user();
        $permissionsArray = [];

        if ($user) {
            $roles = $user->roles;
            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionsArray[$permission->name][] = $role->name;
                }
            }
        }

        return $permissionsArray;
    }
}
