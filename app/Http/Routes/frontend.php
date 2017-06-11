<?php

Route::group(['prefix' => 'social-auth'], function () {
    Route::group(['prefix' => 'facebook'], function () {
        Route::get('redirect/', ['as' => 'fb-auth', 'uses' => 'SocialAuthController@redirect']);
        Route::get('callback/', ['as' => 'fb-callback', 'uses' => 'SocialAuthController@callback']);
        Route::post('fb-login', ['as' => 'ajax-login-by-fb', 'uses' => 'SocialAuthController@fbLogin']);
    });

    Route::group(['prefix' => 'google'], function () {
        Route::get('redirect/', ['as' => 'gg-auth', 'uses' => 'SocialAuthController@googleRedirect']);
        Route::get('callback/', ['as' => 'gg-callback', 'uses' => 'SocialAuthController@googleCallback']);
    });

});

Route::group(['prefix' => 'authentication'], function () {
    Route::post('check_login', ['as' => 'auth-login', 'uses' => 'AuthenticationController@checkLogin']);
    Route::post('login_ajax', ['as' =>  'auth-login-ajax', 'uses' => 'AuthenticationController@checkLoginAjax']);
    Route::get('/user-logout', ['as' => 'user-logout', 'uses' => 'AuthenticationController@logout']);
});
Route::group(['namespace' => 'Frontend'], function()
{

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);    
    Route::get('/user/kho-phim', ['as' => 'kho-phim', 'uses' => 'CustomerController@khoPhim']);
    Route::post('/user/favorite', ['as' => 'favorite', 'uses' => 'CustomerController@favorite']);
    Route::post('/sys/bao-cao-link-hong', ['as' => 'report', 'uses' => 'ReportController@report']);
    //Route::get('/phim-le', ['as' => 'phim-le', 'uses' => 'HomeController@cate']);
    //::get('/phim-bo', ['as' => 'phim-bo', 'uses' => 'HomeController@cate']);
    Route::get('/tin-tuc', ['as' => 'news-list', 'uses' => 'HomeController@newsList']);

    Route::post('/get-link', ['as' => 'get-link', 'uses' => 'DetailController@getLink']);
    Route::get('/streaming/', ['as' => 'get-video-streaming', 'uses' => 'DetailController@streaming']);

    Route::get('/load-tab', ['as' => 'ajax-tab', 'uses' => 'HomeController@ajaxTab']);
    Route::get('phim/{slugName}/xem-phim.html', ['as' => 'detail', 'uses' => 'DetailController@index']);
    Route::get('tags/{tagName}/', ['as' => 'tags', 'uses' => 'HomeController@tags']);
    Route::get('dao-dien/{name}/', ['as' => 'dao-dien', 'uses' => 'HomeController@daoDien']);
    Route::get('dien-vien/{name}/', ['as' => 'dien-vien', 'uses' => 'HomeController@dienVien']);
    Route::get('phim/{slugName}/', ['as' => 'landing', 'uses' => 'DetailController@landing']);
    Route::get('/tin-tuc/{slug}-{id}.html', ['as' => 'news-detail', 'uses' => 'HomeController@newsDetail']);
    Route::get('/phim/{slugName}/{slugEpisode}.html', ['as' => 'detail-tap-phim', 'uses' => 'DetailController@index']);

    Route::get('{slug}', ['as' => 'cate', 'uses' => 'HomeController@cate']);
    Route::get('/movies-info/{movies_id}', ['as' => 'movies-info', 'uses' => 'DetailController@ajaxMoviesInfo']);

    Route::get('/download', ['as' => 'download', 'uses' => 'DetailController@download']);
    Route::get('/tim-kiem.html', ['as' => 'search', 'uses' => 'HomeController@search']);
});