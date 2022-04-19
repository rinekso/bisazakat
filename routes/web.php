<?php

use App\Mail\TransactionConfirmed;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Webklex\IMAP\Facades\Client;

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
 */

Route::group(
    [
        'prefix' => ADMIN,
        'as' => ADMIN . '.',
        'namespace' => 'Admin'
    ],
    function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.submit');
    }
);

Route::group(
    [
        'prefix' => ADMIN,
        'as' => ADMIN . '.',
        'middleware' => ['auth:admin'],
        'namespace' => 'Admin'
    ],
    function () {
        Route::get('/', 'AdminController@index')->name('dash');

        Route::get('/role', 'RoleController@index');
        Route::resource('/users', 'UserController');

        Route::resource('/coa', 'CoAController');
        Route::resource('/categories', 'CategoryController');
        Route::resource('/programs', 'ProgramController');
        Route::resource('/programs/{program}/progress', 'ProgramProgressController');
        Route::resource('/roles', 'RoleController');
        Route::resource('/permissions', 'PermissionController');
        Route::resource('/transactions', 'TransactionController');
        Route::resource('/employees', 'EmployeeController');
        Route::resource('/zakat', 'ZakatController');

        Route::post('/transactions/{transaction}/confirm', 'TransactionController@setConfirmation')->name('transaction.set_confirmation');
        Route::post('/transactions/{transaction}/upload/bukti', 'TransactionController@doUploadProofOfPayment')->name('transaction.proof.upload');

        Route::put('/coa/activation/update/{coa}', 'CoAController@updateActivationStatus');
        Route::get('/site/setings', 'SiteSettingsController@index')->name('site.settings.index');

    }
);

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'program'], function () {
    Route::get('/donasi', 'ProgramController@getProgramDonasi')->name('programs.donasi');
    Route::get('detail/{id}', 'ProgramController@show')->name('programs.detail');
    Route::get('detail/{program}/kontribusi', 'ProgramController@kontribusi')->name('programs.kontribusi');
    Route::post('detail/{program}/kontribusi', 'ProgramController@setNominal')->name('programs.kontribusi.nominal');
    Route::get('detail/{program}/kontribusi/user-info', 'ProgramController@userInfo')->name('programs.kontribusi.user');
    Route::post('detail/{program}/kontribusi/create-transaction', 'ProgramController@createTransaction')->name('programs.kontribusi.createTransaction');
    Route::post('detail/{program}/kontribusi/create-transaction-no-login', 'ProgramController@createTransactionWithoutLogin')->name('programs.kontribusi.createTransactionWithoutLogin');
    Route::get('detail/{program}/kontribusi/ringkasan/{transaction}', 'ProgramController@getSummary')->name('programs.kontribusi.getsummary');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix' => 'zakat'], function () {
    Route::get('/', function () {
        return view('frontend.zakat');
    })->name('programs.zakat');

    Route::post('bayar', 'ZakatController@setNominalZakat')->name('zakat.transaction.initiate');
    Route::get('bayar/{program}/user-info/', 'ZakatController@userInfo')->name('zakat.transaction.user.info');
    Route::post('bayar/{program}/create-transaction', 'ZakatController@createTransaction')->name('zakat.transaction.create');
    Route::post('bayar/{program}/create-transaction/no-login', 'ZakatController@createTransactionWithoutLogin')->name('zakat.transaction.create.withoutLogin');
    Route::get('bayar/{program}/ringkasan/{transaction}', 'ZakatController@getSummary')->name('zakat.transaction.summary');
});

Route::resource('profile', 'ProfileController');

Route::group(['prefix' => 'profile'], function () {
    Route::get('/{profile}/transaksi/histori', 'ProfileController@getTransactionHistory')->name('user.transaction.history');
    Route::post('/{profile}/transaksi/{transaction}/upload/bukti', 'ProfileController@doUploadProofOfPayment')->name('user.transaction.proof.upload');
    Route::get('/{profile}/edit/password', 'ProfileController@editPassword')->name('profile.edit.password');
    Route::put('/{profile}/edit/password', 'ProfileController@updatePassword')->name('profile.update.password');
});

Route::get('/privasi', function () {
    return view('frontend.privasi');
});

Route::get('/layanan', function () {
    return view('frontend.layanan');
});

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider')->name('auth.social');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback')->name('auth.social.callback');

Route::get('test', function () {
    abort(404);
});