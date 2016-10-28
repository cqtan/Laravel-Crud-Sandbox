<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manage_content', [
    //'middleware' => ['auth'],
    'uses' => function () {
      return view('sites.manage_content');
}])->name('manage_content');

// Custom Page create route for passing Subject-id to the view instead of the Page resource route
Route::get('/page/create/{id}', [
    'middleware' => ['auth'],
    'uses' => function ($id) {
      return view('sites.pages.create_page')->with('id', $id);
}]);

Route::resource('/subject','SubjectController');
Route::resource('/page','PageController');

Auth::routes();

Route::get('/home', 'HomeController@index');
