<?php

Route::group([
    'namespace' => 'Membership',
    'prefix' => 'auth'
], function () {
    Route::get('login', 'AuthController@showLogin')->middleware('logout')->name('auth.login');
    Route::get('register', 'AuthController@showRegister')->middleware('logout')->name('auth.register');
    Route::delete('logout', 'AuthController@logout')->name('auth.logout');
    Route::post('login', 'AuthController@login')->middleware('logout');
    Route::post('register', 'AuthController@register')->middleware('logout');
});

Route::group([
    'namespace' => 'Membership',
    'middleware' => 'login'
], function () {
    Route::get('@{uuid}', 'ProfileController@showProfile')->name('profile');
    Route::post('@{uuid}', 'ProfileController@editProfile');
    Route::post('auth/password', 'ProfileController@editPassword')->name('auth.password');
});

Route::group([
    'namespace' => 'Frontend'
], function () {
    Route::get('/', 'HomeController@show')->name('home');
    Route::get('facebook-post', 'FacebookController@post');
});

Route::group([
    'namespace' => 'Frontend',
    'prefix' => 'api_docs'
], function () {
    Route::get('intro', 'ApiDocsController@intro')->name('api_docs.intro');
    Route::get('region', 'ApiDocsController@region')->name('api_docs.region');
    Route::get('office', 'ApiDocsController@office')->name('api_docs.office');
    Route::get('school', 'ApiDocsController@school')->name('api_docs.school');
    Route::get('meal', 'ApiDocsController@meal')->name('api_docs.meal');
    Route::get('calendar', 'ApiDocsController@calendar')->name('api_docs.calendar');
});

Route::group([
    'namespace' => 'Api',
    'prefix' => 'api'
], function () {
    Route::get('region/uuid/{uuid}', 'RegionController@getByUUID')->name('api.region.getByUUID');
    Route::get('region/domain/{name}', 'RegionController@getByDomain')->name('api.region.getByDomain');
    Route::get('region/name/{name}', 'RegionController@getByName')->name('api.region.getByName');
    Route::get('region/offices/{uuid}', 'RegionController@getOffices')->name('api.region.getOffices');

    Route::get('office/uuid/{uuid}', 'OfficeController@getByUUID')->name('api.office.getByUUID');
    Route::get('office/name/{name}', 'OfficeController@getByName')->name('api.office.getByName');

    Route::get('school/{name}', 'SchoolController@getByName')->name('api.school.getByName');

    Route::get('meal', 'MealController@getMeal')->name('api.meal.getMeal');

    Route::get('calendar', 'CalendarController@getCalendar')->name('api.calendar.getCalendar');
});
