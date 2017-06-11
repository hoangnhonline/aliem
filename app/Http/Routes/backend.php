<?php

// Authentication routes...
Route::get('backend/login', ['as' => 'backend.login-form', 'uses' => 'Backend\UserController@loginForm']);
Route::post('backend/login', ['as' => 'backend.check-login', 'uses' => 'Backend\UserController@checkLogin']);
Route::get('backend/logout', ['as' => 'backend.logout', 'uses' => 'Backend\UserController@logout']);

Route::group(['namespace' => 'Backend', 'prefix' => 'backend', 'middleware' => 'isAdmin'], function()
{
    
    // Controllers Within The "App\Http\Controllers\Backend" Namespace
    Route::get('/', ['as' => 'film.index', 'uses' => 'FilmController@index']);    
    Route::group(['prefix' => 'info-seo'], function () {
        Route::get('/', ['as' => 'info-seo.index', 'uses' => 'InfoSeoController@index']);
        Route::get('/create', ['as' => 'info-seo.create', 'uses' => 'InfoSeoController@create']);
        Route::post('/store', ['as' => 'info-seo.store', 'uses' => 'InfoSeoController@store']);
        Route::get('{id}/edit',   ['as' => 'info-seo.edit', 'uses' => 'InfoSeoController@edit']);
        Route::post('/update', ['as' => 'info-seo.update', 'uses' => 'InfoSeoController@update']);
        Route::get('{id}/destroy', ['as' => 'info-seo.destroy', 'uses' => 'InfoSeoController@destroy']);
    });
    Route::group(['prefix' => 'sitemap'], function () {
        Route::get('/', ['as' => 'sitemap.index', 'uses' => 'SiteMapController@index']); 
        Route::get('/add-new', ['as' => 'sitemap.add-new', 'uses' => 'SiteMapController@addNew']); 
        Route::get('/crew', ['as' => 'sitemap.crew', 'uses' => 'SiteMapController@crew']);
        Route::get('/category', ['as' => 'sitemap.category', 'uses' => 'SiteMapController@category']);
        Route::get('/country', ['as' => 'sitemap.country', 'uses' => 'SiteMapController@country']);
        Route::get('/articles', ['as' => 'sitemap.articles', 'uses' => 'SiteMapController@articles']); 
        Route::get('/tag', ['as' => 'sitemap.tag', 'uses' => 'SiteMapController@tag']);
        Route::get('/default', ['as' => 'sitemap.default', 'uses' => 'SiteMapController@default']); 
        Route::get('/movies', ['as' => 'sitemap.movies', 'uses' => 'SiteMapController@movies']);            
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', ['as' => 'report.index', 'uses' => 'ReportController@index']);
        Route::get('/fix/{episode_id}', ['as' => 'report.fix', 'uses' => 'ReportController@fix']);
    });
    
    Route::group(['prefix' => 'articles-cate'], function () {
        Route::get('/', ['as' => 'articles-cate.index', 'uses' => 'ArticlesCateController@index']);
        Route::get('/create', ['as' => 'articles-cate.create', 'uses' => 'ArticlesCateController@create']);
        Route::post('/store', ['as' => 'articles-cate.store', 'uses' => 'ArticlesCateController@store']);
        Route::get('{id}/edit',   ['as' => 'articles-cate.edit', 'uses' => 'ArticlesCateController@edit']);
        Route::post('/update', ['as' => 'articles-cate.update', 'uses' => 'ArticlesCateController@update']);
        Route::get('{id}/destroy', ['as' => 'articles-cate.destroy', 'uses' => 'ArticlesCateController@destroy']);
    }); 
    Route::group(['prefix' => 'tag'], function () {
        Route::get('/', ['as' => 'tag.index', 'uses' => 'TagController@index']);
        Route::get('/create', ['as' => 'tag.create', 'uses' => 'TagController@create']);
        Route::post('/store', ['as' => 'tag.store', 'uses' => 'TagController@store']);
        Route::get('{id}/edit',   ['as' => 'tag.edit', 'uses' => 'TagController@edit']);
        Route::post('/update', ['as' => 'tag.update', 'uses' => 'TagController@update']);
        Route::get('{id}/destroy', ['as' => 'tag.destroy', 'uses' => 'TagController@destroy']);
    });
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'account.index', 'uses' => 'AccountController@index']);
        Route::get('/change-password', ['as' => 'account.change-pass', 'uses' => 'AccountController@changePass']);
        Route::post('/store-password', ['as' => 'account.store-pass', 'uses' => 'AccountController@storeNewPass']);
        Route::get('/update-status/{status}/{id}', ['as' => 'account.update-status', 'uses' => 'AccountController@updateStatus']);
        Route::get('/create', ['as' => 'account.create', 'uses' => 'AccountController@create']);
        Route::post('/store', ['as' => 'account.store', 'uses' => 'AccountController@store']);
        Route::get('{id}/edit',   ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
        Route::post('/update', ['as' => 'account.update', 'uses' => 'AccountController@update']);
        Route::get('{id}/destroy', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy']);
    });
    Route::group(['prefix' => 'film'], function () {
        Route::get('/', ['as' => 'film.index', 'uses' => 'FilmController@index']);
        Route::get('/create', ['as' => 'film.create', 'uses' => 'FilmController@create']);
        Route::post('/store', ['as' => 'film.store', 'uses' => 'FilmController@store']);
        Route::get('{id}/edit',   ['as' => 'film.edit', 'uses' => 'FilmController@edit']);
        Route::post('/update', ['as' => 'film.update', 'uses' => 'FilmController@update']);
        Route::get('{id}/destroy', ['as' => 'film.destroy', 'uses' => 'FilmController@destroy']);
    });  
    Route::group(['prefix' => 'articles'], function () {
        Route::get('/', ['as' => 'articles.index', 'uses' => 'ArticlesController@index']);
        Route::get('/create', ['as' => 'articles.create', 'uses' => 'ArticlesController@create']);
        Route::post('/store', ['as' => 'articles.store', 'uses' => 'ArticlesController@store']);
        Route::get('{id}/edit',   ['as' => 'articles.edit', 'uses' => 'ArticlesController@edit']);
        Route::post('/update', ['as' => 'articles.update', 'uses' => 'ArticlesController@update']);
        Route::get('{id}/destroy', ['as' => 'articles.destroy', 'uses' => 'ArticlesController@destroy']);
    });  
    Route::group(['prefix' => 'category'], function () {
        Route::get('/{parent_id?}', ['as' => 'category.index', 'uses' => 'CategoryController@index'])->where('parent_id', '[0-9]+');
        Route::get('/create', ['as' => 'category.create', 'uses' => 'CategoryController@create']);
        Route::post('/store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
        Route::post('/ajax-list-by-parent', ['as' => 'category.ajax-list-by-parent', 'uses' => 'CategoryController@ajaxListByParent']);
        
        Route::get('{id}/edit',   ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
        Route::post('/update', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
        Route::get('{id}/destroy', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
    }); 
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
        Route::post('/update', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);     
    });
    Route::group(['prefix' => 'country'], function () {
        Route::get('/', ['as' => 'country.index', 'uses' => 'CountryController@index']);
        Route::get('/create', ['as' => 'country.create', 'uses' => 'CountryController@create']);
        Route::post('/store', ['as' => 'country.store', 'uses' => 'CountryController@store']);
        Route::post('/ajax-list-by-parent', ['as' => 'category.ajax-list-by-parent', 'uses' => 'CategoryController@ajaxListByParent']);
        
        Route::get('{id}/edit',   ['as' => 'country.edit', 'uses' => 'CountryController@edit']);
        Route::post('/update', ['as' => 'country.update', 'uses' => 'CountryController@update']);
        Route::get('{id}/destroy', ['as' => 'country.destroy', 'uses' => 'CountryController@destroy']);
    });  
    Route::group(['prefix' => 'crew'], function () {
        Route::get('/', ['as' => 'crew.index', 'uses' => 'CrewController@index']);
        Route::get('/create', ['as' => 'crew.create', 'uses' => 'CrewController@create']);
        Route::post('/store', ['as' => 'crew.store', 'uses' => 'CrewController@store']);
        Route::post('/ajax-list-by-parent', ['as' => 'crew.ajax-list-by-parent', 'uses' => 'CategoryController@ajaxListByParent']);
        
        Route::get('{id}/edit',   ['as' => 'crew.edit', 'uses' => 'CrewController@edit']);
        Route::post('/update', ['as' => 'crew.update', 'uses' => 'CrewController@update']);
        Route::get('{id}/destroy', ['as' => 'crew.destroy', 'uses' => 'CrewController@destroy']);
    });
    Route::group(['prefix' => 'film-episode'], function () {
        Route::get('/{film_id}', ['as' => 'film-episode.index', 'uses' => 'FilmEpisodeController@index']);
        Route::post('/update-order', ['as' => 'update-order-episode', 'uses' => 'FilmEpisodeController@updateOrder']);        
        Route::get('/create', ['as' => 'film-episode.create', 'uses' => 'FilmEpisodeController@create']);
        Route::post('/store', ['as' => 'film-episode.store', 'uses' => 'FilmEpisodeController@store']);
        Route::post('/ajax-list-by-parent', ['as' => 'film-episode.ajax-list-by-parent', 'uses' => 'FilmEpisodeController@ajaxListByParent']);
        
        Route::get('{id}/edit',   ['as' => 'film-episode.edit', 'uses' => 'FilmEpisodeController@edit']);
        Route::post('/update', ['as' => 'film-episode.update', 'uses' => 'FilmEpisodeController@update']);
        Route::get('{id}/destroy', ['as' => 'film-episode.destroy', 'uses' => 'FilmEpisodeController@destroy']);
    });
    Route::group(['prefix' => 'tag'], function () {
        Route::get('/', ['as' => 'tag.index', 'uses' => 'TagController@index']);
        Route::get('/create', ['as' => 'tag.create', 'uses' => 'TagController@create']);
        Route::post('/store', ['as' => 'tag.store', 'uses' => 'TagController@store']);
        Route::post('/ajaxSave', ['as' => 'tag.ajax-save', 'uses' => 'TagController@ajaxSave']);  
        Route::get('/ajax-list', ['as' => 'tag.ajax-list', 'uses' => 'TagController@ajaxList']);       
        
        Route::get('{id}/edit',   ['as' => 'tag.edit', 'uses' => 'TagController@edit']);
        Route::post('/update', ['as' => 'tag.update', 'uses' => 'TagController@update']);
        Route::get('{id}/destroy', ['as' => 'tag.destroy', 'uses' => 'TagController@destroy']);
    });
    Route::group(['prefix' => 'privilege'], function () {
        Route::get('/{user_id}', ['as' => 'privilege.index', 'uses' => 'PrivilegeController@index']);
        Route::post('/update', ['as' => 'privilege.update', 'uses' => 'PrivilegeController@update']);     
    });
    Route::post('/tmp-upload', ['as' => 'image.tmp-upload', 'uses' => 'UploadController@tmpUpload']);
    Route::post('/update-order', ['as' => 'update-order', 'uses' => 'GeneralController@updateOrder']);
    Route::post('/get-slug', ['as' => 'get-slug', 'uses' => 'GeneralController@getSlug']);
    Route::post('/get-film-external', ['as' => 'general.get-film-external', 'uses' => 'GeneralController@getFilmExternal']);
    
});