<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefix = config('lumki.prefix') ?? "lumki";
$lumkiPermission = config('lumki.lumkiPermission') ?? "manage users";
$middleware = config('lumki.middleware') ?? ["auth:sanctum","web","can:$lumkiPermission"];

Route::prefix($prefix)
    ->namespace("Kineticamobile\Lumki\Controllers")
    ->as('lumki.')
    ->middleware($middleware)
    ->group(function () {

    // USERS
    Route::resource('users', 'UserController');
    // ROLES
    Route::resource('roles', 'RoleController');
    // PERMISSIONS
    Route::resource('permissions', 'PermissionController');

});


