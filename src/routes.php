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

Route::prefix('lumki')->middleware(['web','auth:sanctum'])->group(function () {

    Route::get('/', function(Request $request, User $user){
        return redirect(route("lumki.users.index"));
    })->name("lumki.index");

    Route::middleware(['can:manage users'])->group(function () {
        Route::get('users', function(Request $request){
            return view("lumki::index", ["users" => User::paginate(8)]);
        })->name("lumki.users.index");


        Route::get('users/{user}', function(User $user){
            return view("lumki::edit", [
                "user" => $user,
                "roles" => Role::all()
            ]);
        })->name("lumki.user.roles.edit");


        Route::put('users/{user}', function(User $user){
            $user->syncRoles(request('roles'));
            return redirect(route("lumki.users.index"));
        })->name("lumki.user.roles.update");
    });


});


