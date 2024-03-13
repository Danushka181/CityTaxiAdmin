<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Taxi Admin']);
        $serviceProvider = Role::create(['name' => 'Service Provider']);

        $serviceProvider->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-trip',
            'edit-trip',
            'delete-trip'
        ]);
    }
}
