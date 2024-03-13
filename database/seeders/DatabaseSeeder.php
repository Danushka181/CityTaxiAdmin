<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SuperAdminSeeder::class,
            CancelReason::class,
        ]);


        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Taxi Admin',
            'email' => 'test@test.com',
            'mobile' => '0774123391',
        ]);
    }
}
