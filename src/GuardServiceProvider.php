<?php

namespace Ijodkor\Guard;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GuardServiceProvider extends PackageServiceProvider {
    private const APP_NAME = "guard";

    public function configurePackage(Package $package): void {
        $package->name(self::APP_NAME)
            ->hasRoutes('api')
            ->hasConfigFile('guard')
            ->hasMigrations([
                // Schema
                '2025_00_01_000000_create_schemes',

                // User
                'users/2025_01_01_000000_create_users_table',
                'users/2025_01_02_000000_create_organizations_table',

                // Rbac
                'rbac/2025_02_01_000000_create_rbac_roles_table',
                'rbac/2025_02_02_100000_create_rbac_positions_table',
                'rbac/2025_02_03_000000_create_rbac_user_roles_table',
                'rbac/2025_02_04_100000_create_actions_table',
            ]);
    }
}