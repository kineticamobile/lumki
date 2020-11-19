<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Raultm\Pruebas\Facades\Pruebas;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
$middleware = config('lumki.middleware') ?? "auth:sanctum";

Route::prefix($prefix)->middleware(['web',$middleware,'can:manage users'])->group(function () {

    // USERS

    Route::get('users', function(Request $request){
        return view("lumki::users.index", ["users" => User::paginate(8)]);
    })->name("lumki.users.index");


    Route::get('users/{user}', function(User $user){
        return view("lumki::users.edit", [
            "user" => $user,
            "roles" => Role::all()
        ]);
    })->name("lumki.user.roles.edit");


    Route::put('users/{user}', function(User $user){
        $user->syncRoles(request('roles'));
        return redirect(route("lumki.users.index"));
    })->name("lumki.user.roles.update");



    // ROLES

    Route::get('roles', function(Request $request){
        return view("lumki::roles.index", ["roles" => Role::paginate(8)]);
    })->name("lumki.roles.index");

    Route::get('roles/create', function(){
        return view("lumki::roles.create", [
            "permissions" => Permission::all()
        ]);
    })->name("lumki.role.create");

    Route::post('roles', function(){
        Role::create([
            "name" => request("name"),
            "guard_name" => "web"
        ]);
        return redirect(route("lumki.roles.index"));
    })->name("lumki.role.store");

    Route::get('roles/{role}', function(Role $role){
        return view("lumki::roles.edit", [
            "role" => $role,
            "permissions" => Permission::all()
        ]);
    })->name("lumki.role.permissions.edit");

    Route::put('roles/{role}', function(Role $role){
        $role->syncPermissions(request('permissions'));
        return redirect(route("lumki.roles.index"));
    })->name("lumki.role.permissions.update");

    // PERMISSIONS

    Route::get('permissions', function(Request $request){
        return view("lumki::permissions.index", ["permissions" => Permission::paginate(8)]);
    })->name("lumki.permissions.index");

    Route::get('permissions/create', function(){
        return view("lumki::permissions.create");
    })->name("lumki.permission.create");

    Route::post('permissions', function(){
        Permission::create([
            "name" => request("name"),
            "guard_name" => "web"
        ]);
        return redirect(route("lumki.permissions.index"));
    })->name("lumki.permission.store");

});


