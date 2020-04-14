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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//ROUTES DEL WEBSITE
Route::get('/','Website\PageController@index')->name('website.home');

Route::group(['prefix' => '{locale}','where' => ['locale' => '[a-zA-Z]{2}'],'middleware' => 'setlocale'],function(){

    Route::get('/{slug}','Website\PageController@page');
});

//ROUTES DEL CMS
Route::group(['prefix' => 'cms'], function ()
{
    /*
     * Per ogni route che non sia login chiamo il middleware "cms.isauth:cms"
     * cms.isauth è l'alias configurato per il middleware Cms\IsAuth nel Kernel.php
     * :cms corrisponde al tipo di guard che usiamo per l'autenitcazione in config/auth.php
     */
    Route::middleware('cms.isauth:cms')->group(function ()
    {
        Route::get('/', 'Cms\DashboardController@index')->name('cms.dashboard');

        Route::get('/settings', 'Cms\SettingsController@index')->name('cms.settings');
        Route::get('/settings/create_module', 'Cms\SettingsController@create_module')->name('cms.create.module');
        Route::get('/settings/switch_stato_module','Cms\SettingsController@switch_stato_module');
        Route::get('/settings/switch_boolean_config','Cms\SettingsController@switch_boolean_config');
        Route::get('/settings/config_module/{id}','Cms\SettingsController@config_module');
        Route::get('/settings/edit_module/{id}','Cms\SettingsController@edit_module');
        Route::get('/settings/edit_config_module/{id}','Cms\SettingsController@edit_config_module');
        Route::get('/settings/create_config_module/{id}','Cms\SettingsController@create_config_module');
        Route::get('/settings/destroy_config_module/{id}','Cms\SettingsController@destroy_config_module');
        Route::get('/settings/create_copy_config_module/{id}','Cms\SettingsController@create_copy_config_module');
        Route::post('/settings/update_module/{id}','Cms\SettingsController@update_module');
        Route::post('/settings/store_module','Cms\SettingsController@store_module');
        Route::post('/settings/store_config_module','Cms\SettingsController@store_config_module');
        Route::post('/settings/update_config_module/{id}','Cms\SettingsController@update_config_module');
        Route::post('/settings/store_copy_config_module','Cms\SettingsController@store_copy_config_module');


        Route::resource('/seo','Cms\SeoController');
        Route::get('/seo', 'Cms\SeoController@index')->name('cms.seo');

        Route::get('/macrocategory/switch_stato','Cms\MacrocategoryController@switch_stato');
        Route::resource('/macrocategory','Cms\MacrocategoryController');
        Route::get('/macrocategory/move_up/{id}', 'Cms\MacrocategoryController@move_up');
        Route::get('/macrocategory/move_down/{id}', 'Cms\MacrocategoryController@move_down');
        Route::get('/macrocategory/destroy/{id}', 'Cms\MacrocategoryController@destroy');
        Route::get('/macrocategory', 'Cms\MacrocategoryController@index')->name('cms.macrocategorie');


        Route::get('/category/sync_prodotti', 'Cms\CategoryController@sync_prodotti');
        Route::get('/category/sync_file_prodotti', 'Cms\CategoryController@sync_file_prodotti');
        Route::get('/category/sync_abbinamenti', 'Cms\CategoryController@sync_abbinamenti');
        Route::get('/category/sync_file_abbinamenti', 'Cms\CategoryController@sync_file_abbinamenti');
        Route::get('/category/switch_stato','Cms\CategoryController@switch_stato');
        Route::resource('/category','Cms\CategoryController');
        Route::get('/category/move_up/{id}', 'Cms\CategoryController@move_up');
        Route::get('/category/move_down/{id}', 'Cms\CategoryController@move_down');
        Route::get('/category/destroy/{id}', 'Cms\CategoryController@destroy');
        Route::get('/category', 'Cms\CategoryController@index')->name('cms.categorie');

        Route::get('/material/switch_stato','Cms\MaterialController@switch_stato');
        Route::resource('/material','Cms\MaterialController');
        Route::get('/material/move_up/{id}', 'Cms\MaterialController@move_up');
        Route::get('/material/move_down/{id}', 'Cms\MaterialController@move_down');
        Route::get('/material/destroy/{id}', 'Cms\MaterialController@destroy');
        Route::get('/material/images/{id}', 'Cms\MaterialController@images');
        Route::get('/material', 'Cms\MaterialController@index')->name('cms.materiali');

        Route::get('/product/switch_visibility','Cms\ProductController@switch_visibility');
        Route::get('/product/switch_visibility_italfama','Cms\ProductController@switch_visibility_italfama');
        Route::get('/product/switch_offerta','Cms\ProductController@switch_offerta');
        Route::get('/product/switch_novita','Cms\ProductController@switch_novita');
        Route::resource('/product','Cms\ProductController');
        Route::post('/product/upload_images', 'Cms\ProductController@upload_images');
        Route::get('/product/images/{id}', 'Cms\ProductController@images');
        Route::get('/product/destroy/{id}', 'Cms\ProductController@destroy');
        Route::get('/product','Cms\ProductController@index')->name('cms.prodotti');

        Route::get('/pairing/switch_visibility','Cms\PairingController@switch_visibility');
        Route::get('/pairing/switch_visibility_italfama','Cms\PairingController@switch_visibility_italfama');
        Route::get('/pairing/switch_offerta','Cms\PairingController@switch_offerta');
        Route::resource('/pairing','Cms\PairingController');
        Route::get('/pairing/destroy/{id}', 'Cms\PairingController@destroy');
        Route::get('/pairing','Cms\PairingController@index')->name('cms.abbinamenti');

        Route::resource('/news','Cms\NewsController');
        Route::get('/news', 'Cms\NewsController@index')->name('cms.news');

        Route::resource('/offerte','Cms\OfferteController');
        Route::get('/offerte', 'Cms\OfferteController@index')->name('cms.offerte');

        Route::resource('/fotogallery','Cms\FotogalleryController');
        Route::get('/fotogallery', 'Cms\FotogalleryController@index')->name('cms.fotogallery');

        Route::resource('/eventi','Cms\EventiController');
        Route::get('/eventi', 'Cms\EventiController@index')->name('cms.eventi');

        Route::get('/website/domains', 'Cms\WebsiteController@domains')->name('cms.website.domains');
        Route::get('/website/create_domain', 'Cms\WebsiteController@create_domain');
        Route::get('/website/edit_domain/{id}', 'Cms\WebsiteController@edit_domain');
        Route::get('/website/destroy_domain/{id}', 'Cms\WebsiteController@destroy_domain');
        Route::post('/website/update_domain/{id}', 'Cms\WebsiteController@update_domain');
        Route::post('/website/store_domain','Cms\WebsiteController@store_domain');
        Route::get('/website','Cms\WebsiteController@index')->name('cms.website');
        Route::get('/website/pages','Cms\WebsiteController@pages');
        Route::get('/website/create_page','Cms\WebsiteController@create_page');
        Route::get('/website/destroy_page/{id}','Cms\WebsiteController@destroy_page');
        Route::post('/website/store_page','Cms\WebsiteController@store_page');
        Route::get('/website/urls','Cms\WebsiteController@urls');
        Route::get('/website/edit_url/{id}','Cms\WebsiteController@edit_url');
        Route::post('/website/update_url/{id}','Cms\WebsiteController@update_url');


    });

    Route::get('/login', 'Cms\Auth\LoginController@showLoginForm')->name('cms.login');
    Route::post('/login','Cms\Auth\LoginController@login')->name('cms.login');
    Route::get('/logout', 'Cms\Auth\LoginController@logout')->name('cms.logout');
    Route::get('/register','Cms\Auth\RegisterController@showRegistrationForm')->name('cms.register');
    Route::post('/register','Cms\Auth\RegisterController@register');
    Route::get('/password/reset','Cms\Auth\ForgotPasswordController@showLinkRequestForm')->name('cms.password.request');

});
