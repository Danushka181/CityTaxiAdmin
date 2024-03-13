<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Taxi Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('admin')
        ]);
        $superAdmin->assignRole('Taxi Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Call center Admin',
            'email' => 'test@provider.com',
            'password' => Hash::make('provider')
        ]);
        $admin->assignRole('Service Provider');

    }
}
