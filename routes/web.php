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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('can:manage,App\Article');

Route::get('helloworld', function(){
    echo 'Hello World';
});

Route::group([
            'middleware' => ['auth', 'can:manage,App\Article'],
            'prefix' => 'articles',
            'as' => 'articles:'
        ], function(){

    Route::get('/create', 'ArticlesController@create')->name('create');

    Route::post('/create', 'ArticlesController@store')->name('store');

    Route::get('/', 'ArticlesController@index')->name('index');

    Route::group(['middleware' => 'can:update,article'], function () {

        Route::get('/edit/{article}', 'ArticlesController@edit')->name('edit');
        Route::post('/edit/{article}', 'ArticlesController@update')->name('update');

        Route::get('/delete/{article}', 'ArticlesController@delete')->name('delete');
    });



    Route::get('/search', 'ArticlesController@search')->name('search');

    Route::post('/{article}/comment','ArticlesController@comment')->name('comment');
});

Route::group(['as'=>'blog:'], function(){
    Route::get('/','BlogController@index')->name('index');

    Route::get('/posts/{article}','BlogController@getArticle')->name('post')->middleware('can:view,article');

    Route::get('/categories/{category}','BlogController@getByCategory')->name('category');
});

