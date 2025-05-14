<?php

namespace Ijodkor\Guard\Database\Seeders;

use Ijodkor\Guard\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::query()->create([
            'name' => "Ma\u{2019}mur",
            'username' => 'admin',
            'pin' => 12345678912345,
            'email' => 'admin@joriy.uz',
            'password' => Hash::make('admin')
        ]);
    }
}
