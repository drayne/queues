<?php

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

$router->get('/email', 'EmailController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/proba-delay', 'RabbitController@rabbitDelay');
Route::get('/proba', 'RabbitController@rabbit');
Route::get('/consume', 'RabbitController@consume');


Route::get('/generate', function (){
   factory(\App\Article::class, 100)->create();
});

Route::resource('article', 'ArticleController');

Route::get('/test', function (){
    $client = new \GuzzleHttp\Client();
    $data = $client->request('GET','https://reqres.in/api/users?page=2');
    dd($data->getBody());
});

Route::prefix('async')->group(function(){
    Route::get('/guzzle', 'AsyncController@guzzle');
    Route::get('/spatie/{number}', 'AsyncController@spatie');
});