# Lumki

Laravel Users Management to Laravel 8 Jetstream (Using [Spatie/LaravelPermissions](https://github.com/spatie/laravel-permission) & [Lab404/LaravelImpersonate](https://github.com/404labfr/laravel-impersonate)).

## Functionalities

<details open="true">
<summary>Impersonation / Leave:</summary>

![Gif showing impersonation][impersonation_gif]

</details>

<details>
<summary>Add Role To User: </summary>

![Gif showing hot to add Role to User][users_gif]

</details>

<details>
<summary>Roles - Create and associate Permissions: </summary>

![Gif adding new Roles and adding permissions to Role][roles_gif]

</details>

<details>
<summary>Permissions - Index and create new:  </summary>

![Gif creating new permissions][permissions_gif]

</details>

[impersonation_gif]: assets/user_impersonation_leave.gif
[users_gif]: assets/users_add_role.gif
[roles_gif]: assets/roles_index_create_permissions.gif
[permissions_gif]: assets/permissions_index_create.gif

| Functionality          | Working | Test  |
| ---------------------- |:-------:|:-----:|
| User - Index           | ✓       | ⨯     |
| User - Edit Roles      | ✓       | ⨯     |
| Role - Index           | ✓       | ⨯     |
| Role - Edit Permissions| ✓       | ⨯     |
| Role - Create          | ✓       | ⨯     |
| Permission - Index     | ✓       | ⨯     |
| Permission - Create    | ✓       | ⨯     |
| Blade @lumki           | ✓       | ⨯     |
| Command to Setup       | ✓       | ⨯     |

✓/⨯

## Installation

Via Composer

``` bash
$ composer require kineticamobile/lumki
```

## Setup over Laravel 8 Jetstream at least one User registered to associate permissions

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

### Customizable prefix for your routes

To change the prefix `lumki` in your routes you must publish the configuration

``` bash
$ php artisan vendor:publish --tag=lumki.config 
```

Now, you can edit the file `config/lumki.php` and change the prefix from 'lumki' to whatever you want, empty string allowed, if this field is null 'lumki' is set as default value.

### Error 'GuardDoesNotMatch'

If you are struggling with the error of GuardDoesNotMatch could be that you have modified the provider in your `config/auth.php` file

In order to solve this problem you can specify the guard name of the model.

Eg: If you are using User Model but with an ldap connection using LdapRecord you can resolve this problem adding the code above in your User Model

``` php
class User extends Authenticatable
{
    // ...

    public function guardName(){
        return "web";
    }
}


```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

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
