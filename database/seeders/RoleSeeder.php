<?php

namespace Ijodkor\Guard\Database\Seeders;

use Ijodkor\Guard\Entities\RoleTypeEntity;
use Ijodkor\Guard\Models\Rbac\Role;
use Ijodkor\Guard\Models\Rbac\UserRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $role = Role::query()->create([
            'type' => RoleTypeEntity::ADMIN,
            'name' => "Super admin",
            'title' => [
                'uz' => "Tizim ma\u{2019}mur",
                'qq' => "Sistema administratorı",
                'ru' => "Администратор",
                'en' => "Admin",
            ],
            'level' => 0
        ]);

        UserRole::query()->create([
            'user_id' => 1,
            'role_id' => $role->id
        ]);
    }
}
