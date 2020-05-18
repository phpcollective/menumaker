<?php

Route::name('menu-maker::')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::redirect('/', 'roles/assign');

    Route::put('roles/assign', 'RoleController@assign')->name('roles.assign');
    Route::get('roles/menus', 'RoleController@menus')->name('roles.menus');
    Route::get('menus/{node}/tree', 'MenuController@tree')->name('menus.tree');
    Route::resources([
         'roles'   => 'RoleController',
         'sections' => 'SectionController',
         'menus'    => 'MenuController'
     ]);
    Route::get('selected-menus', 'MenuController@selected')->name('menus.selected');

    Route::resource('users', 'UserController')->only(['index', 'edit', 'update']);

    Route::get('filter-menus', 'MenuController@filter')->name('menus.filter');
    Route::get('permissions', 'PermissionController@index')->name('permissions.index');
    Route::get('permissions/selected', 'PermissionController@selected')->name('permissions.selected');
    Route::put('permissions', 'PermissionController@update')->name('permissions.update');
});
