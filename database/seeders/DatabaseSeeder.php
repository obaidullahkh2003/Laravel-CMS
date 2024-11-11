<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Viewer']);
        Role::create(['name' => 'Editor']);
        $admin =Admin::create([
            'name' => 'Super Admin',
            'email' => "admin@admin.com",
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('Super Admin');



    }
}
