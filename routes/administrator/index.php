<?php

use App\Events\ChatPusherEvent;
use App\Http\Requests\PusherChatRequest;
use App\Models\Chat;
use App\Models\ChatImage;
use App\Models\Notification;
use App\Models\ParticipantChat;
use App\Models\RestfulAPI;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@loginAdmin')->name('login_admin');
Route::post('/admin', 'App\Http\Controllers\Admin\AdminController@postLoginAdmin');

Route::get('/admin/logout', [
    'as' => 'administrator.logout',
    'uses' => '\App\Http\Controllers\Admin\AdminController@logout'
]);

Route::prefix('administrator')->group(function () {

    Route::prefix('password')->group(function () {
        Route::get('/', [
            'as' => 'administrator.password.index',
            'uses' => 'App\Http\Controllers\Admin\AdminController@password',
        ]);
        Route::put('/', [
            'as' => 'administrator.password.update',
            'uses' => 'App\Http\Controllers\Admin\AdminController@updatePassword',
        ]);

    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [
            'as' => 'administrator.dashboard.index',
            'uses' => 'App\Http\Controllers\Admin\DashboardController@index',
        ]);

    });

    Route::prefix('history-datas')->group(function () {
        Route::get('/', [
            'as' => 'administrator.history_data.index',
            'uses' => 'App\Http\Controllers\Admin\HistoryDataController@index',
            'middleware' => 'can:history_datas-list',
        ]);

    });

    Route::prefix('logos')->group(function () {
        Route::get('/', [
            'as' => 'administrator.logos.add',
            'uses' => 'App\Http\Controllers\Admin\LogoController@create',
            'middleware' => 'can:logos-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.logos.store',
            'uses' => 'App\Http\Controllers\Admin\LogoController@store',
            'middleware' => 'can:logos-add',
        ]);

    });

    Route::prefix('publishers')->group(function () {

        Route::get('/', [
            'as' => 'administrator.users.index',
            'uses' => 'App\Http\Controllers\Admin\UserController@index',
            'middleware' => 'can:users-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.users.create',
            'uses' => 'App\Http\Controllers\Admin\UserController@create',
            'middleware' => 'can:users-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.users.store',
            'uses' => 'App\Http\Controllers\Admin\UserController@store',
            'middleware' => 'can:users-add',
        ]);

        Route::get('/edit', [
            'as' => 'administrator.users.edit',
            'uses' => 'App\Http\Controllers\Admin\UserController@edit',
            'middleware' => 'can:users-edit',
        ]);

        Route::put('/update', [
            'as' => 'administrator.users.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@update',
            'middleware' => 'can:users-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.users.delete',
            'uses' => 'App\Http\Controllers\Admin\UserController@delete',
            'middleware' => 'can:users-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.users.delete_many',
            'uses' => 'App\Http\Controllers\Admin\UserController@deleteManyByIds',
            'middleware' => 'can:users-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.users.export',
            'uses' => 'App\Http\Controllers\Admin\UserController@export',
            'middleware' => 'can:users-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.users.get',
            'uses' => 'App\Http\Controllers\Admin\UserController@get',
            'middleware' => 'can:users-list',
        ]);

        Route::put('/update_active', [
            'as' => 'administrator.users.update.active',
            'uses' => 'App\Http\Controllers\Admin\UserController@updateActive',
            'middleware' => 'can:users-list',
        ]);

    });

    Route::prefix('partner')->group(function () {

        Route::get('/', [
            'as' => 'administrator.partner.index',
            'uses' => 'App\Http\Controllers\Admin\UserController@indexPartner',
            'middleware' => 'can:partners-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.partner.store',
            'uses' => 'App\Http\Controllers\Admin\UserController@storePartner',
            'middleware' => 'can:partners-add',
        ]);

        Route::get('/edit', [
            'as' => 'administrator.partner.edit',
            'uses' => 'App\Http\Controllers\Admin\UserController@editPartner',
            'middleware' => 'can:partners-edit',
        ]);

        Route::put('/update', [
            'as' => 'administrator.partner.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@updatePartner',
            'middleware' => 'can:partners-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.partner.delete',
            'uses' => 'App\Http\Controllers\Admin\UserController@delete',
            'middleware' => 'can:partners-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.partner.delete_many',
            'uses' => 'App\Http\Controllers\Admin\UserController@deleteManyByIds',
            'middleware' => 'can:partners-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.partner.export',
            'uses' => 'App\Http\Controllers\Admin\UserController@export',
            'middleware' => 'can:partners-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.partner.get',
            'uses' => 'App\Http\Controllers\Admin\UserController@get',
            'middleware' => 'can:partners-list',
        ]);

        Route::put('/update_active', [
            'as' => 'administrator.partner.update.active',
            'uses' => 'App\Http\Controllers\Admin\UserController@updateActive',
            'middleware' => 'can:partners-edit',
        ]);

    });

    Route::prefix('websites')->group(function () {

        Route::get('/', [
            'as' => 'administrator.websites.index',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@index',
            'middleware' => 'can:websites-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.websites.create',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@create',
            'middleware' => 'can:websites-add',
        ]);

        Route::post('/', [
            'as' => 'administrator.websites.store',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@store',
            'middleware' => 'can:websites-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.websites.edit',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@edit',
            'middleware' => 'can:websites-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.websites.update',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@update',
            'middleware' => 'can:websites-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.websites.delete',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@delete',
            'middleware' => 'can:websites-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.websites.delete_many',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@deleteManyByIds',
            'middleware' => 'can:websites-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.websites.export',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@export',
            'middleware' => 'can:websites-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.websites.get',
            'uses' => 'App\Http\Controllers\Admin\WebsiteController@get',
            'middleware' => 'can:websites-list',
        ]);

    });

    Route::prefix('ads')->group(function () {

        Route::get('/', [
            'as' => 'administrator.ads.index',
            'uses' => 'App\Http\Controllers\Admin\AdsController@index',
            'middleware' => 'can:ads-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.ads.create',
            'uses' => 'App\Http\Controllers\Admin\AdsController@create',
            'middleware' => 'can:ads-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.ads.store',
            'uses' => 'App\Http\Controllers\Admin\AdsController@store',
            'middleware' => 'can:ads-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.ads.edit',
            'uses' => 'App\Http\Controllers\Admin\AdsController@edit',
            'middleware' => 'can:ads-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.ads.update',
            'uses' => 'App\Http\Controllers\Admin\AdsController@update',
            'middleware' => 'can:ads-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.ads.delete',
            'uses' => 'App\Http\Controllers\Admin\AdsController@delete',
            'middleware' => 'can:ads-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.ads.delete_many',
            'uses' => 'App\Http\Controllers\Admin\AdsController@deleteManyByIds',
            'middleware' => 'can:ads-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.ads.export',
            'uses' => 'App\Http\Controllers\Admin\AdsController@export',
            'middleware' => 'can:ads-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.ads.get',
            'uses' => 'App\Http\Controllers\Admin\AdsController@get',
            'middleware' => 'can:ads-list',
        ]);

        Route::prefix('advertiser')->group(function () {
            Route::put('/{id}', [
                'as' => 'administrator.ads.advertiser.update',
                'uses' => 'App\Http\Controllers\Admin\AdsController@updateAdvertisers',
                'middleware' => 'can:ads-add',
            ]);

            Route::post('/{ads_id}', [
                'as' => 'administrator.ads.advertiser.store',
                'uses' => 'App\Http\Controllers\Admin\AdsController@storeZone',
                'middleware' => 'can:ads-add',
            ]);

        });

    });

    Route::prefix('type_categorys')->group(function () {

        Route::get('/', [
            'as' => 'administrator.type_categories.index',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@index',
            'middleware' => 'can:type_categorys-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.type_categories.create',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@create',
            'middleware' => 'can:type_categorys-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.type_categories.store',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@store',
            'middleware' => 'can:type_categorys-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.type_categories.edit',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@edit',
            'middleware' => 'can:type_categorys-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.type_categories.update',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@update',
            'middleware' => 'can:type_categorys-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.type_categories.delete',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@delete',
            'middleware' => 'can:type_categorys-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.type_categories.delete_many',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@deleteManyByIds',
            'middleware' => 'can:type_categorys-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.type_categories.export',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@export',
            'middleware' => 'can:type_categorys-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.type_categories.get',
            'uses' => 'App\Http\Controllers\Admin\TypeCategoryController@get',
            'middleware' => 'can:type_categorys-list',
        ]);

    });

    Route::prefix('zones')->group(function () {

        Route::get('/', [
            'as' => 'administrator.advertises.index',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@index',
            'middleware' => 'can:advertises-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.advertises.create',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@create',
            'middleware' => 'can:advertises-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.advertises.store',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@store',
            'middleware' => 'can:advertises-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.advertises.edit',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@edit',
            'middleware' => 'can:advertises-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.advertises.update',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@update',
            'middleware' => 'can:advertises-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.advertises.delete',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@delete',
            'middleware' => 'can:advertises-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.advertises.delete_many',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@deleteManyByIds',
            'middleware' => 'can:advertises-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.advertises.export',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@export',
            'middleware' => 'can:advertises-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.advertises.get',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@get',
            'middleware' => 'can:advertises-list',
        ]);

        Route::get('/detail/{id}', [
            'as' => 'administrator.advertises.detail.index',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@indexDetail',
            'middleware' => 'can:advertises-config',
        ]);

        Route::post('/detail/config/{id}', [
            'as' => 'administrator.advertises.detail.config.store',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@storeDetailConfig',
            'middleware' => 'can:advertises-add',
        ]);

        Route::put('/detail/zone/{id}', [
            'as' => 'administrator.advertises.detail.zone.update',
            'uses' => 'App\Http\Controllers\Admin\AdvertiseController@updateDetailZone',
            'middleware' => 'can:advertises-edit',
        ]);

    });

    Route::prefix('campaigns')->group(function () {
        Route::post('/update', [
            'as' => 'administrator.campaign.update',
            'uses' => 'App\Http\Controllers\Admin\CampaignController@update',
        ]);
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/', [
            'as' => 'administrator.contacts.index',
            'uses' => 'App\Http\Controllers\Admin\contactController@index',
            'middleware' => 'can:contacts-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.contacts.create',
            'uses' => 'App\Http\Controllers\Admin\contactController@create',
            'middleware' => 'can:contacts-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.contacts.store',
            'uses' => 'App\Http\Controllers\Admin\contactController@store',
            'middleware' => 'can:contacts-add',
        ]);

        Route::get('/response/{id}', [
            'as' => 'administrator.contacts.response',
            'uses' => 'App\Http\Controllers\Admin\contactController@response',
            'middleware' => 'can:contacts-edit',
        ]);

        Route::post('/response', [
            'as' => 'administrator.contacts.send',
            'uses' => 'App\Http\Controllers\Admin\contactController@sendResponse',
            'middleware' => 'can:contacts-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.contacts.update',
            'uses' => 'App\Http\Controllers\Admin\contactController@update',
            'middleware' => 'can:contacts-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.contacts.delete',
            'uses' => 'App\Http\Controllers\Admin\contactController@delete',
            'middleware' => 'can:contacts-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.contacts.delete_many',
            'uses' => 'App\Http\Controllers\Admin\contactController@deleteManyByIds',
            'middleware' => 'can:contacts-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.contacts.export',
            'uses' => 'App\Http\Controllers\Admin\contactController@export',
            'middleware' => 'can:contacts-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.contacts.get',
            'uses' => 'App\Http\Controllers\Admin\contactController@get',
            'middleware' => 'can:contacts-list',
        ]);

    });


    Route::prefix('chats')->group(function () {
        Route::get('/', [
            'as' => 'administrator.chats.index',
            'uses' => 'App\Http\Controllers\Admin\ChatController@index',
            'middleware' => 'can:chats-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.chats.create',
            'uses' => 'App\Http\Controllers\Admin\ChatController@create',
            'middleware' => 'can:chats-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.chats.store',
            'uses' => 'App\Http\Controllers\Admin\ChatController@store',
            'middleware' => 'can:chats-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.chats.edit',
            'uses' => 'App\Http\Controllers\Admin\ChatController@edit',
            'middleware' => 'can:chats-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.chats.update',
            'uses' => 'App\Http\Controllers\Admin\ChatController@update',
            'middleware' => 'can:chats-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.chats.delete',
            'uses' => 'App\Http\Controllers\Admin\ChatController@delete',
            'middleware' => 'can:chats-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.chats.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ChatController@deleteManyByIds',
            'middleware' => 'can:chats-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.chats.export',
            'uses' => 'App\Http\Controllers\Admin\ChatController@export',
            'middleware' => 'can:chats-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.chats.get',
            'uses' => 'App\Http\Controllers\Admin\ChatController@get',
            'middleware' => 'can:chats-list',
        ]);

    });

    Route::prefix('employees')->group(function () {
        Route::get('/', [
            'as' => 'administrator.employees.index',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@index',
            'middleware' => 'can:employees-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.employees.create',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@create',
            'middleware' => 'can:employees-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.employees.store',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@store',
            'middleware' => 'can:employees-add',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.employees.update',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@update',
            'middleware' => 'can:employees-edit',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.employees.edit',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@edit',
            'middleware' => 'can:employees-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.employees.delete',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@delete',
            'middleware' => 'can:employees-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.employees.delete_many',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@deleteManyByIds',
            'middleware' => 'can:employees-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.employees.export',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@export',
            'middleware' => 'can:employees-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.employees.get',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@get',
            'middleware' => 'can:employees-list',
        ]);

    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'administrator.roles.index',
            'uses' => 'App\Http\Controllers\Admin\RoleController@index',
            'middleware' => 'can:roles-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.roles.create',
            'uses' => 'App\Http\Controllers\Admin\RoleController@create',
            'middleware' => 'can:roles-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.roles.edit',
            'uses' => 'App\Http\Controllers\Admin\RoleController@edit',
            'middleware' => 'can:roles-edit',
        ]);

        Route::post('/store', [
            'as' => 'administrator.roles.store',
            'uses' => 'App\Http\Controllers\Admin\RoleController@store',
            'middleware' => 'can:roles-add',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.roles.update',
            'uses' => 'App\Http\Controllers\Admin\RoleController@update',
            'middleware' => 'can:roles-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.roles.delete',
            'uses' => 'App\Http\Controllers\Admin\RoleController@delete',
            'middleware' => 'can:roles-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.roles.delete_many',
            'uses' => 'App\Http\Controllers\Admin\RoleController@deleteManyByIds',
            'middleware' => 'can:roles-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.roles.export',
            'uses' => 'App\Http\Controllers\Admin\RoleController@export',
            'middleware' => 'can:roles-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.roles.get',
            'uses' => 'App\Http\Controllers\Admin\RoleController@get',
            'middleware' => 'can:roles-list',
        ]);

    });

    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'administrator.permissions.create',
            'uses' => 'App\Http\Controllers\Admin\PermissionController@create',
            'middleware' => 'can:permissions-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.permissions.store',
            'uses' => 'App\Http\Controllers\Admin\PermissionController@store',
            'middleware' => 'can:permissions-add',
        ]);

    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'administrator.sliders.index',
            'uses' => 'App\Http\Controllers\Admin\SliderController@index',
            'middleware' => 'can:sliders-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.sliders.create',
            'uses' => 'App\Http\Controllers\Admin\SliderController@create',
            'middleware' => 'can:sliders-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.sliders.store',
            'uses' => 'App\Http\Controllers\Admin\SliderController@store',
            'middleware' => 'can:sliders-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.sliders.edit',
            'uses' => 'App\Http\Controllers\Admin\SliderController@edit',
            'middleware' => 'can:sliders-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.sliders.update',
            'uses' => 'App\Http\Controllers\Admin\SliderController@update',
            'middleware' => 'can:sliders-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.sliders.delete',
            'uses' => 'App\Http\Controllers\Admin\SliderController@delete',
            'middleware' => 'can:sliders-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.sliders.delete_many',
            'uses' => 'App\Http\Controllers\Admin\SliderController@deleteManyByIds',
            'middleware' => 'can:sliders-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.sliders.export',
            'uses' => 'App\Http\Controllers\Admin\SliderController@export',
            'middleware' => 'can:sliders-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.sliders.get',
            'uses' => 'App\Http\Controllers\Admin\SliderController@get',
            'middleware' => 'can:sliders-list',
        ]);

    });

    Route::prefix('news')->group(function () {
        Route::get('/', [
            'as' => 'administrator.news.index',
            'uses' => 'App\Http\Controllers\Admin\NewsController@index',
            'middleware' => 'can:news-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.news.create',
            'uses' => 'App\Http\Controllers\Admin\NewsController@create',
            'middleware' => 'can:news-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.news.store',
            'uses' => 'App\Http\Controllers\Admin\NewsController@store',
            'middleware' => 'can:news-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.news.edit',
            'uses' => 'App\Http\Controllers\Admin\NewsController@edit',
            'middleware' => 'can:news-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.news.update',
            'uses' => 'App\Http\Controllers\Admin\NewsController@update',
            'middleware' => 'can:news-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.news.delete',
            'uses' => 'App\Http\Controllers\Admin\NewsController@delete',
            'middleware' => 'can:news-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.news.delete_many',
            'uses' => 'App\Http\Controllers\Admin\NewsController@deleteManyByIds',
            'middleware' => 'can:news-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.news.export',
            'uses' => 'App\Http\Controllers\Admin\NewsController@export',
            'middleware' => 'can:news-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.news.get',
            'uses' => 'App\Http\Controllers\Admin\NewsController@get',
            'middleware' => 'can:news-list',
        ]);

    });

    Route::prefix('job-emails')->group(function () {
        Route::get('/', [
            'as' => 'administrator.job_emails.index',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@index',
            'middleware' => 'can:job_emails-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.job_emails.store',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@store',
            'middleware' => 'can:job_emails-add',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.job_emails.delete',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@delete',
            'middleware' => 'can:job_emails-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.job_emails.delete_many',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@deleteManyByIds',
            'middleware' => 'can:job_emails-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.job_emails.export',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@export',
            'middleware' => 'can:job_emails-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.job_emails.get',
            'uses' => 'App\Http\Controllers\Admin\JobEmailController@get',
            'middleware' => 'can:job_emails-list',
        ]);

    });

    Route::prefix('job-notifications')->group(function () {
        Route::get('/', [
            'as' => 'administrator.job_notifications.index',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@index',
            'middleware' => 'can:job_notifications-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.job_notifications.create',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@create',
            'middleware' => 'can:job_notifications-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.job_notifications.store',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@store',
            'middleware' => 'can:job_notifications-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.job_notifications.edit',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@edit',
            'middleware' => 'can:job_notifications-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.job_notifications.update',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@update',
            'middleware' => 'can:job_notifications-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.job_notifications.delete',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@delete',
            'middleware' => 'can:job_notifications-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.job_notifications.delete_many',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@deleteManyByIds',
            'middleware' => 'can:job_notifications-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.job_notifications.export',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@export',
            'middleware' => 'can:job_notifications-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.job_notifications.get',
            'uses' => 'App\Http\Controllers\Admin\JobNotificationController@get',
            'middleware' => 'can:job_notifications-list',
        ]);

    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'administrator.categories.index',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@index',
            'middleware' => 'can:categories-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.categories.create',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@create',
            'middleware' => 'can:categories-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.categories.store',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@store',
            'middleware' => 'can:categories-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.categories.edit',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@edit',
            'middleware' => 'can:categories-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.categories.update',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@update',
            'middleware' => 'can:categories-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.categories.delete',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@delete',
            'middleware' => 'can:categories-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.categories.delete_many',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@deleteManyByIds',
            'middleware' => 'can:categories-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.categories.export',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@export',
            'middleware' => 'can:categories-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.categories.get',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@get',
            'middleware' => 'can:categories-list',
        ]);

    });

    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'administrator.products.index',
            'uses' => 'App\Http\Controllers\Admin\ProductController@index',
            'middleware' => 'can:products-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.products.create',
            'uses' => 'App\Http\Controllers\Admin\ProductController@create',
            'middleware' => 'can:products-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.products.store',
            'uses' => 'App\Http\Controllers\Admin\ProductController@store',
            'middleware' => 'can:products-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.products.edit',
            'uses' => 'App\Http\Controllers\Admin\ProductController@edit',
            'middleware' => 'can:products-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.products.update',
            'uses' => 'App\Http\Controllers\Admin\ProductController@update',
            'middleware' => 'can:products-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.products.delete',
            'uses' => 'App\Http\Controllers\Admin\ProductController@delete',
            'middleware' => 'can:products-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.products.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ProductController@deleteManyByIds',
            'middleware' => 'can:products-delete',
        ]);

        Route::get('/export', [
            'as'=>'administrator.products.export',
            'uses'=>'App\Http\Controllers\Admin\ProductController@export',
            'middleware'=>'can:products-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.products.get',
            'uses' => 'App\Http\Controllers\Admin\ProductController@get',
            'middleware' => 'can:products-list',
        ]);

    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'administrator.settings.index',
            'uses' => 'App\Http\Controllers\Admin\SettingController@index',
            'middleware' => 'can:settings-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.settings.create',
            'uses' => 'App\Http\Controllers\Admin\SettingController@create',
            'middleware' => 'can:settings-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.settings.store',
            'uses' => 'App\Http\Controllers\Admin\SettingController@store',
            'middleware' => 'can:settings-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.settings.edit',
            'uses' => 'App\Http\Controllers\Admin\SettingController@edit',
            'middleware' => 'can:settings-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.settings.update',
            'uses' => 'App\Http\Controllers\Admin\SettingController@update',
            'middleware' => 'can:settings-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.settings.delete',
            'uses' => 'App\Http\Controllers\Admin\SettingController@delete',
            'middleware' => 'can:settings-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.settings.delete_many',
            'uses' => 'App\Http\Controllers\Admin\SettingController@deleteManyByIds',
            'middleware' => 'can:settings-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.settings.export',
            'uses' => 'App\Http\Controllers\Admin\SettingController@export',
            'middleware' => 'can:settings-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.settings.get',
            'uses' => 'App\Http\Controllers\Admin\SettingController@get',
            'middleware' => 'can:settings-list',
        ]);

    });

    Route::prefix('category-news')->group(function () {
        Route::get('/', [
            'as' => 'administrator.category_news.index',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@index',
            'middleware' => 'can:category_news-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.category_news.create',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@create',
            'middleware' => 'can:category_news-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.category_news.store',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@store',
            'middleware' => 'can:category_news-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.category_news.edit',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@edit',
            'middleware' => 'can:category_news-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.category_news.update',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@update',
            'middleware' => 'can:category_news-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.category_news.delete',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@delete',
            'middleware' => 'can:category_news-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.category_news.delete_many',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@deleteManyByIds',
            'middleware' => 'can:category_news-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.category_news.export',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@export',
            'middleware' => 'can:category_news-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.category_news.get',
            'uses' => 'App\Http\Controllers\Admin\CategoryNewController@get',
            'middleware' => 'can:category_news-list',
        ]);

    });

    Route::prefix('system-branches')->group(function () {
        Route::get('/', [
            'as' => 'administrator.system_branches.index',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@index',
            'middleware' => 'can:system_branches-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.system_branches.create',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@create',
            'middleware' => 'can:system_branches-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.system_branches.store',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@store',
            'middleware' => 'can:system_branches-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.system_branches.edit',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@edit',
            'middleware' => 'can:system_branches-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.system_branches.update',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@update',
            'middleware' => 'can:system_branches-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.system_branches.delete',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@delete',
            'middleware' => 'can:system_branches-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.system_branches.delete_many',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@deleteManyByIds',
            'middleware' => 'can:system_branches-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.system_branches.export',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@export',
            'middleware' => 'can:system_branches-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.system_branches.get',
            'uses' => 'App\Http\Controllers\Admin\SystemBranchController@get',
            'middleware' => 'can:system_branches-list',
        ]);
    });

    Route::prefix('quotations')->group(function () {
        Route::get('/', [
            'as' => 'administrator.quotations.index',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@index',
            'middleware' => 'can:quotations-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.quotations.create',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@create',
            'middleware' => 'can:quotations-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.quotations.store',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@store',
            'middleware' => 'can:quotations-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.quotations.edit',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@edit',
            'middleware' => 'can:quotations-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.quotations.update',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@update',
            'middleware' => 'can:quotations-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.quotations.delete',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@delete',
            'middleware' => 'can:quotations-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.quotations.delete_many',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@deleteManyByIds',
            'middleware' => 'can:quotations-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.quotations.export',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@export',
            'middleware' => 'can:quotations-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.quotations.get',
            'uses' => 'App\Http\Controllers\Admin\QuotationController@get',
            'middleware' => 'can:quotations-list',
        ]);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [
            'as' => 'administrator.orders.index',
            'uses' => 'App\Http\Controllers\Admin\OrderController@index',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.orders.create',
            'uses' => 'App\Http\Controllers\Admin\OrderController@create',
            'middleware' => 'can:orders-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.orders.store',
            'uses' => 'App\Http\Controllers\Admin\OrderController@store',
            'middleware' => 'can:orders-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.orders.edit',
            'uses' => 'App\Http\Controllers\Admin\OrderController@edit',
            'middleware' => 'can:orders-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.orders.update',
            'uses' => 'App\Http\Controllers\Admin\OrderController@update',
            'middleware' => 'can:orders-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.orders.delete',
            'uses' => 'App\Http\Controllers\Admin\OrderController@delete',
            'middleware' => 'can:orders-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.orders.delete_many',
            'uses' => 'App\Http\Controllers\Admin\OrderController@deleteManyByIds',
            'middleware' => 'can:orders-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.orders.export',
            'uses' => 'App\Http\Controllers\Admin\OrderController@export',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.orders.import',
            'uses' => 'App\Http\Controllers\Admin\OrderController@import',
            'middleware' => 'can:orders-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.orders.get',
            'uses' => 'App\Http\Controllers\Admin\OrderController@get',
            'middleware' => 'can:orders-list',
        ]);
    });

    Route::prefix('vouchers')->group(function () {
        Route::get('/', [
            'as' => 'administrator.vouchers.index',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@index',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.vouchers.create',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@create',
            'middleware' => 'can:vouchers-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.vouchers.store',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@store',
            'middleware' => 'can:vouchers-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.vouchers.edit',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@edit',
            'middleware' => 'can:vouchers-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.vouchers.update',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@update',
            'middleware' => 'can:vouchers-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.vouchers.delete',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@delete',
            'middleware' => 'can:vouchers-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.vouchers.delete_many',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@deleteManyByIds',
            'middleware' => 'can:vouchers-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.vouchers.export',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@export',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.vouchers.import',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@import',
            'middleware' => 'can:vouchers-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.vouchers.get',
            'uses' => 'App\Http\Controllers\Admin\VoucherController@get',
            'middleware' => 'can:vouchers-list',
        ]);
    });

    Route::prefix('reports')->group(function () {
        Route::get('/', [
            'as' => 'administrator.reports.index',
            'uses' => 'App\Http\Controllers\Admin\ReportController@index',
            'middleware' => 'can:reports-list',
        ]);

        Route::get('/update', [
            'as' => 'administrator.reports.updateReport',
            'uses' => 'App\Http\Controllers\Admin\ReportController@updateReport',
            'middleware' => 'can:reports-list',
        ]);
        Route::post('/update', [
            'as' => 'administrator.reports.updateItemReport',
            'uses' => 'App\Http\Controllers\Admin\ReportController@updateItemReport',
            'middleware' => 'can:reports-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.reports.create',
            'uses' => 'App\Http\Controllers\Admin\ReportController@create',
            'middleware' => 'can:reports-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.reports.store',
            'uses' => 'App\Http\Controllers\Admin\ReportController@store',
            'middleware' => 'can:reports-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.reports.edit',
            'uses' => 'App\Http\Controllers\Admin\ReportController@edit',
            'middleware' => 'can:reports-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.reports.update',
            'uses' => 'App\Http\Controllers\Admin\ReportController@update',
            'middleware' => 'can:reports-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.reports.delete',
            'uses' => 'App\Http\Controllers\Admin\ReportController@delete',
            'middleware' => 'can:reports-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.reports.delete_many',
            'uses' => 'App\Http\Controllers\Admin\ReportController@deleteManyByIds',
            'middleware' => 'can:reports-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.reports.export',
            'uses' => 'App\Http\Controllers\Admin\ReportController@export',
            'middleware' => 'can:reports-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.reports.import',
            'uses' => 'App\Http\Controllers\Admin\ReportController@import',
            'middleware' => 'can:reports-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.reports.get',
            'uses' => 'App\Http\Controllers\Admin\ReportController@get',
            'middleware' => 'can:reports-list',
        ]);
    });

    Route::prefix('notification-customs')->group(function () {
        Route::get('/', [
            'as' => 'administrator.notification_customs.index',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@index',
            'middleware' => 'can:notification_customs-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.notification_customs.create',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@create',
            'middleware' => 'can:notification_customs-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.notification_customs.store',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@store',
            'middleware' => 'can:notification_customs-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.notification_customs.edit',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@edit',
            'middleware' => 'can:notification_customs-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.notification_customs.update',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@update',
            'middleware' => 'can:notification_customs-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.notification_customs.delete',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@delete',
            'middleware' => 'can:notification_customs-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.notification_customs.delete_many',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@deleteManyByIds',
            'middleware' => 'can:notification_customs-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.notification_customs.export',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@export',
            'middleware' => 'can:notification_customs-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.notification_customs.import',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@import',
            'middleware' => 'can:notification_customs-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.notification_customs.get',
            'uses' => 'App\Http\Controllers\Admin\NotificationCustomController@get',
            'middleware' => 'can:notification_customs-list',
        ]);
    });

    Route::prefix('percent')->group(function () {

        Route::get('/', [
            'as' => 'administrator.percent.edit',
            'uses' => 'App\Http\Controllers\Admin\SettingController@editPercent',
            'middleware' => 'can:settings-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.percent.update',
            'uses' => 'App\Http\Controllers\Admin\SettingController@updatePercent',
            'middleware' => 'can:settings-edit',
        ]);

    });

    Route::prefix('wallet')->group(function () {
        Route::get('/', [
            'as' => 'administrator.withdraw_users.index',
            'uses' => 'App\Http\Controllers\Admin\WalletController@index',
            'middleware' => 'can:withdraw_users-list',
        ]);

        Route::get('/depositWalletPublisher', [
            'as' => 'administrator.withdraw_users.depositWalletPublisher',
            'uses' => 'App\Http\Controllers\Admin\WalletController@depositWalletPublisher',
        ]);

        Route::get('/create', [
            'as' => 'administrator.withdraw_users.create',
            'uses' => 'App\Http\Controllers\Admin\WalletController@create',
            'middleware' => 'can:withdraw_users-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.withdraw_users.store',
            'uses' => 'App\Http\Controllers\Admin\WalletController@store',
            'middleware' => 'can:withdraw_users-add',
        ]);

        Route::get('/edit', [
            'as' => 'administrator.withdraw_users.edit',
            'uses' => 'App\Http\Controllers\Admin\WalletController@edit',
            'middleware' => 'can:withdraw_users-edit',
        ]);

        Route::put('/update', [
            'as' => 'administrator.withdraw_users.update',
            'uses' => 'App\Http\Controllers\Admin\WalletController@update',
            'middleware' => 'can:withdraw_users-edit',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'administrator.withdraw_users.delete',
            'uses' => 'App\Http\Controllers\Admin\WalletController@delete',
            'middleware' => 'can:withdraw_users-delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'administrator.withdraw_users.delete_many',
            'uses' => 'App\Http\Controllers\Admin\WalletController@deleteManyByIds',
            'middleware' => 'can:withdraw_users-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.withdraw_users.export',
            'uses' => 'App\Http\Controllers\Admin\WalletController@export',
            'middleware' => 'can:withdraw_users-list',
        ]);

        Route::get('/import', [
            'as' => 'administrator.withdraw_users.import',
            'uses' => 'App\Http\Controllers\Admin\WalletController@import',
            'middleware' => 'can:withdraw_users-list',
        ]);

        Route::get('/{id}', [
            'as' => 'administrator.withdraw_users.get',
            'uses' => 'App\Http\Controllers\Admin\WalletController@get',
            'middleware' => 'can:withdraw_users-list',
        ]);

    });

    Route::prefix('api')->group(function () {
        Route::get('/', [
            'as' => 'administrator.api.index',
            'uses' => 'App\Http\Controllers\Admin\SettingController@editAPI',
            'middleware' => 'can:settings-list',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.api.update',
            'uses' => 'App\Http\Controllers\Admin\SettingController@updateAPI',
            'middleware' => 'can:settings-edit',
        ]);

    });

    Route::prefix('ads_txt')->group(function () {
        Route::get('/', [
            'as' => 'administrator.ads_txt.index',
            'uses' => 'App\Http\Controllers\Admin\SettingController@editAdsTxt',
            'middleware' => 'can:settings-list',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.ads_txt.update',
            'uses' => 'App\Http\Controllers\Admin\SettingController@updateAdsTxt',
            'middleware' => 'can:settings-edit',
        ]);

    });

    Route::get('/get_national',[
        'as' => 'administrator.detail.get.national',
        'uses' => 'App\Http\Controllers\Admin\AdvertiseController@getNational',
    ]);

    Route::get('/get_typezone',[
        'as' => 'administrator.detail.get.typezone',
        'uses' => 'App\Http\Controllers\Admin\AdvertiseController@getTypeZone',
    ]);

    Route::post('impersonate', [UserController::class, 'imperrsonate'])->name('administrator.imperrsonate');
});

