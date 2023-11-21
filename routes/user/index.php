<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\User\UserController;

Route::get('redirect/{driver}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Cái này dùng để login, đăng ký và verify
Auth::routes(['verify' => true]);

Route::get('/login', [UserController::class, 'login_user'])->name('login');

Route::prefix('/')->middleware(['auth','verified'])->group(function () {

    Route::get('/', function (){

        if (auth()->user()->active == 0){
            auth()->logout();
            return redirect()->route('login');
        }

        return redirect()->route('user.dashboard.index');
    });

    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [
            'as' => 'user.dashboard.index',
            'uses' => 'App\Http\Controllers\User\DashboardController@index',
        ]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'user.settings.index',
            'uses' => 'App\Http\Controllers\User\SettingController@index',
        ]);

        Route::post('/profile', [
            'as' => 'user.settings.updateProfile',
            'uses' => 'App\Http\Controllers\User\SettingController@update_profile',
        ]);

        Route::post('/password', [
            'as' => 'user.settings.updatePass',
            'uses' => 'App\Http\Controllers\User\SettingController@update_pass',
        ]);
    });

    Route::prefix('websites')->group(function () {

        Route::get('/', [
            'as' => 'user.websites.index',
            'uses' => 'App\Http\Controllers\User\WebsiteController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.websites.create',
            'uses' => 'App\Http\Controllers\User\WebsiteController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.websites.store',
            'uses' => 'App\Http\Controllers\User\WebsiteController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.websites.edit',
            'uses' => 'App\Http\Controllers\User\WebsiteController@edit',
        ]);

        Route::put('/update', [
            'as' => 'user.websites.update',
            'uses' => 'App\Http\Controllers\User\WebsiteController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.websites.delete',
            'uses' => 'App\Http\Controllers\User\WebsiteController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.websites.delete_many',
            'uses' => 'App\Http\Controllers\User\WebsiteController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.websites.export',
            'uses' => 'App\Http\Controllers\User\WebsiteController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.websites.get',
            'uses' => 'App\Http\Controllers\User\WebsiteController@get',
        ]);

    });

    Route::prefix('advs')->group(function () {

        Route::get('/', [
            'as' => 'user.advertises.index',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.advertises.create',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.advertises.store',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.advertises.edit',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'user.advertises.update',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.advertises.delete',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.advertises.delete_many',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.advertises.export',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@export',
        ]);

        Route::get('/download-txt', [
            'as' => 'user.advertises.download_txt',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@downloadTxt',
        ]);

        Route::get('/{id}', [
            'as' => 'user.advertises.get',
            'uses' => 'App\Http\Controllers\User\AdvertiseController@get',
        ]);

    });

    Route::prefix('reports')->group(function () {

        Route::get('/', [
            'as' => 'user.reports.index',
            'uses' => 'App\Http\Controllers\User\ReportController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.reports.create',
            'uses' => 'App\Http\Controllers\User\ReportController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.reports.store',
            'uses' => 'App\Http\Controllers\User\ReportController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.reports.edit',
            'uses' => 'App\Http\Controllers\User\ReportController@edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'user.reports.update',
            'uses' => 'App\Http\Controllers\User\ReportController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.reports.delete',
            'uses' => 'App\Http\Controllers\User\ReportController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.reports.delete_many',
            'uses' => 'App\Http\Controllers\User\ReportController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.reports.export',
            'uses' => 'App\Http\Controllers\User\ReportController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.reports.get',
            'uses' => 'App\Http\Controllers\User\ReportController@get',
        ]);

    });

    Route::prefix('wallet')->group(function () {

        Route::get('/', [
            'as' => 'user.wallet_users.index',
            'uses' => 'App\Http\Controllers\User\WalletController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.wallet_users.create',
            'uses' => 'App\Http\Controllers\User\WalletController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.wallet_users.store',
            'uses' => 'App\Http\Controllers\User\WalletController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.wallet_users.edit',
            'uses' => 'App\Http\Controllers\User\WalletController@edit',
        ]);

        Route::put('/update', [
            'as' => 'user.wallet_users.update',
            'uses' => 'App\Http\Controllers\User\WalletController@update',
        ]);

        Route::delete('/delete', [
            'as' => 'user.wallet_users.delete',
            'uses' => 'App\Http\Controllers\User\WalletController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.wallet_users.delete_many',
            'uses' => 'App\Http\Controllers\User\WalletController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.wallet_users.export',
            'uses' => 'App\Http\Controllers\User\WalletController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.wallet_users.get',
            'uses' => 'App\Http\Controllers\User\WalletController@get',
        ]);

    });

    Route::prefix('payment')->group(function () {

        Route::get('/', [
            'as' => 'user.withdraw_users.index',
            'uses' => 'App\Http\Controllers\User\PaymentController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.withdraw_users.create',
            'uses' => 'App\Http\Controllers\User\PaymentController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.withdraw_users.store',
            'uses' => 'App\Http\Controllers\User\PaymentController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.withdraw_users.edit',
            'uses' => 'App\Http\Controllers\User\PaymentController@edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'user.withdraw_users.update',
            'uses' => 'App\Http\Controllers\User\PaymentController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.withdraw_users.delete',
            'uses' => 'App\Http\Controllers\User\PaymentController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.withdraw_users.delete_many',
            'uses' => 'App\Http\Controllers\User\PaymentController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.withdraw_users.export',
            'uses' => 'App\Http\Controllers\User\PaymentController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.withdraw_users.get',
            'uses' => 'App\Http\Controllers\User\PaymentController@get',
        ]);

    });

    Route::prefix('transections')->group(function () {

        Route::get('/', [
            'as' => 'user.transection_users.index',
            'uses' => 'App\Http\Controllers\User\TransectionController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.transection_users.create',
            'uses' => 'App\Http\Controllers\User\TransectionController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.transection_users.store',
            'uses' => 'App\Http\Controllers\User\TransectionController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.transection_users.edit',
            'uses' => 'App\Http\Controllers\User\TransectionController@edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'user.transection_users.update',
            'uses' => 'App\Http\Controllers\User\TransectionController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.transection_users.delete',
            'uses' => 'App\Http\Controllers\User\TransectionController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.transection_users.delete_many',
            'uses' => 'App\Http\Controllers\User\TransectionController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.transection_users.export',
            'uses' => 'App\Http\Controllers\User\TransectionController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.transection_users.get',
            'uses' => 'App\Http\Controllers\User\TransectionController@get',
        ]);

    });

    Route::prefix('preferences')->group(function () {

        Route::get('/', [
            'as' => 'user.preferences_users.index',
            'uses' => 'App\Http\Controllers\User\PreferencesController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.preferences_users.create',
            'uses' => 'App\Http\Controllers\User\PreferencesController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.preferences_users.store',
            'uses' => 'App\Http\Controllers\User\PreferencesController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.preferences_users.edit',
            'uses' => 'App\Http\Controllers\User\PreferencesController@edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'user.preferences_users.update',
            'uses' => 'App\Http\Controllers\User\PreferencesController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.preferences_users.delete',
            'uses' => 'App\Http\Controllers\User\PreferencesController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.preferences_users.delete_many',
            'uses' => 'App\Http\Controllers\User\PreferencesController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.preferences_users.export',
            'uses' => 'App\Http\Controllers\User\PreferencesController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.preferences_users.get',
            'uses' => 'App\Http\Controllers\User\PreferencesController@get',
        ]);

    });

    Route::prefix('contacts')->group(function () {

        Route::get('/', [
            'as' => 'user.contacts.index',
            'uses' => 'App\Http\Controllers\User\ContactController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.contacts.create',
            'uses' => 'App\Http\Controllers\User\ContactController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.contacts.store',
            'uses' => 'App\Http\Controllers\User\ContactController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.contacts.edit',
            'uses' => 'App\Http\Controllers\User\ContactController@edit',
        ]);

        Route::put('/update', [
            'as' => 'user.contacts.update',
            'uses' => 'App\Http\Controllers\User\ContactController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.contacts.delete',
            'uses' => 'App\Http\Controllers\User\ContactController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.contacts.delete_many',
            'uses' => 'App\Http\Controllers\User\ContactController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.contacts.export',
            'uses' => 'App\Http\Controllers\User\ContactController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.contacts.get',
            'uses' => 'App\Http\Controllers\User\ContactController@get',
        ]);

        Route::get('/contacts', [
            'as' => 'user.contacts.contactList',
            'uses' => 'App\Http\Controllers\User\ContactController@contacts',
        ]);

        Route::post('/response', [
            'as' => 'user.contacts.response',
            'uses' => 'App\Http\Controllers\User\ContactController@response',
        ]);

    });

    Route::prefix('notification')->group(function () {

        Route::get('/', [
            'as' => 'user.notification_customs.index',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@index',
        ]);

        Route::get('/create', [
            'as' => 'user.notification_customs.create',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@create',
        ]);

        Route::post('/store', [
            'as' => 'user.notification_customs.store',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.notification_customs.edit',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'user.notification_customs.update',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@update',
        ]);

        Route::delete('/delete/{id}', [
            'as' => 'user.notification_customs.delete',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@delete',
        ]);

        Route::delete('/delete-many', [
            'as' => 'user.notification_customs.delete_many',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@deleteManyByIds',
        ]);

        Route::get('/export', [
            'as' => 'user.notification_customs.export',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@export',
        ]);

        Route::get('/{id}', [
            'as' => 'user.notification_customs.get',
            'uses' => 'App\Http\Controllers\User\NotificationCustomController@get',
        ]);

    });

    Route::prefix('password')->group(function () {
        Route::get('/', [
            'as' => 'user.password.index',
            'uses' => 'App\Http\Controllers\User\UserController@password',
        ]);
        Route::put('/', [
            'as' => 'user.password.update',
            'uses' => 'App\Http\Controllers\User\UserController@updatePassword',
        ]);

    });

    Route::prefix('ajax')->group(function (){
        Route::get('/getSite', [
            'as' => 'user.ajax.getSite',
            'uses' => 'App\Http\Controllers\User\AjaxController@getSite',
        ]);

        Route::post('/addZone', [
            'as' => 'user.ajax.addzone',
            'uses' => 'App\Http\Controllers\User\AjaxController@createZone',
        ]);

        Route::get('/getCode', [
            'as' => 'user.ajax.getcode',
            'uses' => 'App\Http\Controllers\User\AjaxController@getCode',
        ]);

        Route::get('/getMethod', [
            'as' => 'user.ajax.getmethod',
            'uses' => 'App\Http\Controllers\User\AjaxController@getMethod',
        ]);

        Route::get('/getType', [
            'as' => 'user.ajax.gettype',
            'uses' => 'App\Http\Controllers\User\AjaxController@getType',
        ]);

        Route::get('/editMethod', [
            'as' => 'user.ajax.editmethod',
            'uses' => 'App\Http\Controllers\User\AjaxController@editMethod',
        ]);

        // Lấy thông tin reports
        Route::get('reports', [
            'as' => 'user.ajax.reports.list',
            'uses' => 'App\Http\Controllers\User\ReportController@apiListReport',
        ]);
        Route::get('reports/export', [
            'as' => 'user.ajax.reports.list',
            'uses' => 'App\Http\Controllers\User\ReportController@apiListReport',
        ]);

        Route::group(['prefix' => 'zones'], function (){
            Route::post('/store', [
                'as' => 'user.ajax.zone.store',
                'uses' => 'App\Http\Controllers\User\ZoneController@store',
            ]);
        });

        Route::group(['prefix' => 'websites'], function (){
            Route::get('/', [
                'as' => 'user.ajax.websites.listWebsiteInPage',
                'uses' => 'App\Http\Controllers\User\WebsiteController@listWebsiteInPage',
            ]);
        });
    });

    Route::get('faqs', function (){
       return view('publisher.pages.faqs');
    })->name('user.faqs');

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

});

// Đăng ký referral
Route::get('/{code}', [UserController::class, 'showSignUpReferral'])->name('show.signUpReferral');
