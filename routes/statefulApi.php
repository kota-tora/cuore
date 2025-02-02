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
    Route::get('get_images_parts', 'GalleryController@getImagesParts')->name('get_images_parts');
    Route::get('get_youtube_movies', 'GalleryController@getUpYoutubeMovies')->name('get_up_youtube_movies');
    Route::get('get_youtube_movies_parts', 'GalleryController@getUpYoutubeMoviesParts')
        ->name('get_up_youtube_movies_parts');
});