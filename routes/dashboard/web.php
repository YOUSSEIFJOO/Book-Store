<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::prefix('dashboard')->name('dashboard.')->middleware(["auth", "role:super-admin|admin"])->group(function () {

        Route::get('/', "WelcomeController@index")->name("welcome");

        // Book Controller.
        Route::resource('books', "BookController")->except("show");

        // Comment Controller.
        Route::resource('comments', "CommentController")->except("show");

        // Author Controller.
        Route::resource('authors', "AuthorController")->except("show");

        // Category Controller.
        Route::resource('categories', "CategoryController")->except("show");

        // User Controller.
        Route::resource('users', "UserController")->except("show");


    });

});
