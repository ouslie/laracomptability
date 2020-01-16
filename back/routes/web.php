<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::resource('bases', 'BasesController');
    Route::delete('bases/destroy', 'BasesController@massDestroy')->name('bases.massDestroy');

    Route::get('change_base/{id}', 'BasesController@changebase')->name('bases.change');


    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');

    Route::resource('categories', 'CategoriesController');

    Route::delete('accounts/destroy', 'AccountsController@massDestroy')->name('accounts.massDestroy');

    Route::resource('accounts', 'AccountsController');

});
