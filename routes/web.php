<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\RolesPermission\Models\Role;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile',                                      'ProfileController@editProfile')->name('username');
Route::get('/profile/username',                             'Auth\ProfileController@edit')->name('edit-profile');
Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');

//Route::get('/profile/username',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);

Route::get('/test', function () {
    /*return Role::create([
        'name'=>'Admin',
        'slug'=>'admin',
        'description'=>'Administrador',
        'full-access'=>'yes'
    ]);*/

    $user = User::find(1);
    //$user->roles()->attach([1,3]);// crear relaciones
    //$user->roles()->detach([3]);// eliminar relaciones
    $user->roles()->sync([1]);// eliminar relaciones
    return $user->roles;
});


