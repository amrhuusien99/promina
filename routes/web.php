<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([ 'namespace' => 'App\Http\Controllers\Admin'], function() {
    
    Route::get('/', 'HomeController@home')->name('admin/index');
    Route::get('get/albums', 'HomeController@albums')->name('get/albums');

        
        // album routes
        Route::get('albums/index/{offset?}/{limit?}', 'AlbumController@index')->name('admin/albums/index');
        Route::get('albums/create', 'AlbumController@create')->name('admin/albums/create');
        Route::post('albums/create', 'AlbumController@store')->name('admin/albums/store');
        Route::get('albums/edit/{id?}', 'AlbumController@edit')->name('admin/albums/edit');
        Route::post('albums/edit/{id}', 'AlbumController@update')->name('admin/albums/update');
        Route::get('albums/activate', 'AlbumController@activate')->name('admin/albums/activate');
        Route::get('albums/delete', 'AlbumController@delete')->name('admin/albums/delete');
        Route::post('albums/pagination/{offset?}/{limit?}', 'AlbumController@pagination')->name('admin/albums/pagination');
        Route::post('albums/search', 'AlbumController@search')->name('admin/albums/search');
        Route::get('albums/archives/{offset?}/{limit?}', 'AlbumController@archives')->name('admin/albums/archives');
        Route::get('albums/back', 'AlbumController@back')->name('admin/albums/back');
        Route::post('albums/pagination/archives/{offset?}/{limit?}', 'AlbumController@archivesPagination')->name('admin/albums/pagination/archives');
        Route::post('albums/search/archives', 'AlbumController@archivesSearch')->name('admin/albums/search/archives');
        Route::post('albums/move-pictures/{id}', 'AlbumController@movePictures')->name('admin/albums/move-pictures');

        
      //ROUTEFROMCOMMANDLINE
});
