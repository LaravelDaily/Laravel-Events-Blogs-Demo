<?php

Route::get('/', 'HomePageController@index')->name('home');
Route::get('events', 'EventsController@index')->name('events.index');
Route::get('events/{event:slug}', 'EventsController@show')->name('events.show');
Route::get('posts/{post:slug}', 'PostsController@show')->name('posts.show');

Route::get('/home', function () {
    $routeName = auth()->user()->is_blog_writer ? 'admin.posts.index' : 'admin.events.index';

    if (session('status')) {
        return redirect()->route($routeName)->with('status', session('status'));
    }

    return redirect()->route($routeName);
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Sports
    Route::delete('sports/destroy', 'SportsController@massDestroy')->name('sports.massDestroy');
    Route::resource('sports', 'SportsController');

    // Regions
    Route::delete('regions/destroy', 'RegionsController@massDestroy')->name('regions.massDestroy');
    Route::resource('regions', 'RegionsController');

    // Charities
    Route::delete('charities/destroy', 'CharitiesController@massDestroy')->name('charities.massDestroy');
    Route::resource('charities', 'CharitiesController');

    // Events
    Route::get('events/check_slug', 'EventsController@checkSlug')->name('events.checkSlug');
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Posts
    Route::get('posts/check_slug', 'PostsController@checkSlug')->name('posts.checkSlug');
    Route::delete('posts/destroy', 'PostsController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostsController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostsController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::resource('posts', 'PostsController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
