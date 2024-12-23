<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Api',
], function () {
    Route::get('get_news_lists', 'NewsController@getUpNews')->name('get_news_lists');
    Route::get('get_news', 'NewsController@getNews')->name('get_news');
    Route::post('contact', 'ContactController@post')->name('contact');
    Route::get('get_categories', 'CategoryController@getCategories')->name('get_categories');
    Route::post('recruit', 'RecruitController@post')->name('recruit');
    Route::get('get_all_gallery_by_type', 'GalleryController@getUpGalleries')->name('get_all_gallery_images');
});