# Lumki

Laravel Users Management to Laravel 8 Jetstream (Using [Spatie/LaravelPermissions](https://github.com/spatie/laravel-permission) & [Lab404/LaravelImpersonate](https://github.com/404labfr/laravel-impersonate)).

## Functionalities

| Functionality         | Working | Test  |
| --------------------- |:-------------:|:-----:|
| List Users            | ✓       | ⨯     |
| -pagination           | ✓       | ⨯     |
| -impersonation link   | ✓       | ⨯     |
| Edit User Roles       | ✓       | ⨯     |
| Command               | -       | ⨯     |
| -publish Permissions  | ✓       | ⨯     |
| -publish Impersonate  | ✓       | ⨯     |
| -traits Permissions   | ✓       | ⨯     |
| -traits Impersonate   | ✓       | ⨯     |
| -run migrations       | ✓       | ⨯     |
| -Routes Impersonate   | ✓       | ⨯     |
| -Add user menu        | ✓       | ⨯     |
| -Create Roles/Perm    | ✓       | ⨯     |

✓/⨯

## Installation

Via Composer adding repository before

``` bash
$ composer config repositories.lumki vcs https://github.com/kineticamobile/lumki
```

``` bash
$ composer require kineticamobile/lumki
```

## Setup on Laravel 8 Jetstream fresh install

``` bash
$ php artisan lumki:setup
```

## Explained setup

### Publish spatie/laravel-permissions

``` bash
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### Publish lab404/laravel-permissions

``` bash
$ php artisan vendor:publish --tag=impersonate
```

### Add permissions traits to Models/User

``` php
Lumki::insertLineAfter(
    app_path("Models/User.php"),
    "use Laravel\Jetstream\HasProfilePhoto;",
    "use Spatie\Permission\Traits\HasRoles;"
);
```

``` php
Lumki::insertLineAfter(
    app_path("Models/User.php"),
    "use HasProfilePhoto;",
    "use HasRoles;"
);
```

### Add impersonate traits to Models/User

``` php
Lumki::insertLineAfter(
    app_path("Models/User.php"),
    "use Spatie\Permission\Traits\HasRoles;",
    "use Lab404\Impersonate\Models\Impersonate;"
);
```

``` php
Lumki::insertLineAfter(
    app_path("Models/User.php"),
    "use HasRoles;",
    "use Impersonate;"
);
```
### Run migrations

``` bash
$ php artisan migrate
```

### Add Impersonate Routes 

``` php
Lumki::insertLineBefore(
        base_path("routes/web.php"),
        "Route::get('/', function () {",
        "Route::impersonate();\n"
);
```

### Add Lumki menu items in User's menu

``` php
Lumki::insertLineBefore(
        resource_path('views/navigation-dropdown.blade.php'),
        "@if (Laravel\Jetstream\Jetstream::hasApiFeatures())",
        "\n@lumki\n"
);
```

### Add roles/permissions
``` php
$r1 = Role::firstOrCreate(["name" => "Superadmin"]);
$r2 = Role::firstOrCreate(["name" => "Admin"]);
$r3 = Role::firstOrCreate(["name" => "User"]);

$p1 = Permission::firstOrCreate(['name' => 'manage users']);

$r1->givePermissionTo('manage users');

$user = User::first();
$user->assignRole($r1);
$user->assignRole($r2);
$user->assignRole($r3);
```

## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/kineticamobile/lumki.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/kineticamobile/lumki.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/kineticamobile/lumki/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/kineticamobile/lumki
[link-downloads]: https://packagist.org/packages/kineticamobile/lumki
[link-travis]: https://travis-ci.org/kineticamobile/lumki
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/kineticamobile
[link-contributors]: ../../contributors
