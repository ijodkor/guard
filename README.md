# Laravel guard - Access control for state information systems, including RBAC, LBACK, ABAC

Role access by level, position and type

### Glossaries

- RBAC - role based access
- LBAC - level based access (republic, province, district > ...)
- ABAC\RABAC - (Restricted) Action based access

## Installation and setup

The package will automatically register itself.

Publish migrations
```bash
php artisan vendor:publish --provider="Ijodkor\Guard\GuardServiceProvider" --tag="guard-migrations"
```

Adjust multischeme for project to service provider
```php 
AppServiceProvider ...

/**
* Bootstrap any application services.
*/
public function boot(): void {
    $main = database_path('migrations');
    $directories = ['public', 'users', 'rbac'];
    $paths = [];
    foreach ($directories as $directory) {
        $paths[] = database_path('migrations' . DIRECTORY_SEPARATOR . $directory);
    }

    $paths = array_merge([$main], $paths);
    $this->loadMigrationsFrom($paths);
}
```

And define search path of schemas to database.php
```php
...
'pgsql' => [
    'driver' => 'pgsql',
    ....
    'search_path' => SchemeList::schemas(),
],
...
```

Run migration

```bash
php artisan migrate
```

Add seeders to Database seeder in your project

```php

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
```

Run database seeder

```bash
php artisan db:seed
```

### Customize models

Extend user from guard user

```php
use Ijodkor\Guard\Models\User as GuardUser;

class User extends GuardUser {

}
...
```

## References

### Links

- [HasManyThrough](https://dev.to/mahmudulhsn/laravel-has-many-through-relationship-explained-with-example-22p4)
- [Get route name in middleware](https://laracasts.com/discuss/channels/general-discussion/get-controlller-name-and-action-in-middleware)

## Remainder

Add extra middleware and use this to customize built-in middleware

[Illuminate Foundation](https://packagist.org/packages/illuminate/foundation) abandoned, so we change use
Illuminate\Foundation\Auth\User as Authenticatable in UserModel 
