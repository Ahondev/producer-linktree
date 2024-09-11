<?php

namespace Database\Seeders;

use App\Http\Middleware\IsAdministrator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => IsAdministrator::ADMINISTRATOR_EMAIL,
            'password' => 'NQPCsm48nl0w4Zk'
        ]);
    }
}
