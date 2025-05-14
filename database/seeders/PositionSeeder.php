<?php

namespace Ijodkor\Guard\Database\Seeders;

use Ijodkor\Guard\Models\Rbac\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Position::query()->create([
            'name' => "Rahbar",
        ]);
    }
}
