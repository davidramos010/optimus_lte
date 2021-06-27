<?php

// Creacion de roles y permisos
Route::get('/test', function () {
    /*return Role::create([
        'name'=>'Admin',
        'slug'=>'admin',
        'description'=>'Administrador',
        'full-access'=>'yes'
    ]);*/

    //$user = User::find(2);
    //$user->roles()->attach([2]);// crear relaciones
    //$user->roles()->detach([3]);// eliminar relaciones
    //$user->roles()->sync([1]);// eliminar relaciones
    //return $user->roles;

    /*Asiganacion de permisos*/
    //return Permission::create(['name'=>'Create Product','slug'=>'product.created','description'=>'El usuario puede crear un producto.']);
    //return Permission::create(['name'=>'List Product','slug'=>'product.index','description'=>'El usuario puede listar productos.']);

    //$role = Role::find(1);
    //$role->permissions()->sync([1,2]);
    //return $role->permissions;
});
