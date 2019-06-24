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
})->name('frontend.landing');


Route::namespace('BackEnd')->prefix('admin')->middleware('admin')->group(function () {      // Backend Routes
    
    Route::get('home', 'Home@index')->name('admin.home');
    Route::resource('users', 'Users')->except(['show']);                                             // Users Routes
    Route::resource('categories', 'Categories')->except(['show']);                                  // Categories Routes 
    Route::resource('skills', 'Skills')->except(['show']);                                         // Skills Routes
    Route::resource('tags', 'Tags')->except(['show']);                                            // Tags Routes
    Route::resource('pages', 'Pages')->except(['show']);                                         // Pages Routes
    Route::resource('videos', 'Videos')->except(['show']);                                      // Videos Routes
    Route::resource('messages', 'Messages')->only(['index', 'destroy', 'edit']);                // Messages Routes
    Route::post('comments', 'Videos@commentStore')->name('comment.store');                    // Comments Routes
    Route::get('comments/{id}', 'Videos@commentDelete')->name('comment.delete');             // Comments Routes
    Route::post('comments/{id}', 'Videos@commentUpdate')->name('comment.update');           // Comments Routes
    
});

Auth::routes();

        // Frontend Routes

Route::get('/home', 'HomeController@index')->name('home');
Route::get( '/category/{id}', 'HomeController@category')->name('front.category');                                   // Category Routes
Route::get('/skill/{id}', 'HomeController@skills')->name('front.skill');                                           // Skills Routes
Route::get('/tag/{id}', 'HomeController@tags')->name('front.tag');                                                // Tags Routes
Route::get('/video/{id}', 'HomeController@video')->name('front.video');                                          // video Routes
Route::post('/contact-us', 'HomeController@messageStore')->name('contact.store');                               // Messages Routes

Route::middleware('auth')->group(function () {

    Route::post('/comment/{id}', 'HomeController@commentUpdate')->name('front.update-comment');                  // Comments Routes
    Route::post('/comment/{id}/create', 'HomeController@commentStore')->name('front.store-comment');             // Comments Routes
});

