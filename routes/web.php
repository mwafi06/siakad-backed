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

/*
 * middleware authenticate user
 */
Route::middleware(['auth'])->group(function () {
    /*
     * home module
     */
    Route::namespace('Home')->group(function () {
        Route::get('/', 'Home@index')->name('home')->middleware('block-page:home,read');
    });

    /*
     * employee module
     */
    Route::namespace('Employee')->prefix('employee')->group(function () {
        Route::get('/', 'Employee@index')->name('employee')->middleware('block-page:employee,read');
        Route::get('/add', 'Employee@add')->name('employee.add')->middleware('block-page:employee,create');
        Route::post('/save', 'Employee@save')->name('employee.save')->middleware('block-page:employee,create');
        Route::get('/edit/{id?}', 'Employee@edit')->name('employee.edit')->middleware('block-page:employee,update');
        Route::post('/update', 'Employee@update')->name('employee.update')->middleware('block-page:employee,update');
        Route::get('/delete/{id?}', 'Employee@delete')->name('employee.delete')->middleware('block-page:employee,delete');
    });

    /*
     * employee Group module
     */
    Route::namespace('EmployeeGroup')->prefix('employee-group')->group(function () {
        Route::get('/', 'EmployeeGroup@index')->name('employee-group')->middleware('block-page:employee-group,read');
        Route::get('/add', 'EmployeeGroup@add')->name('employee-group.add')->middleware('block-page:employee-group,create');
        Route::post('/save', 'EmployeeGroup@save')->name('employee-group.save')->middleware('block-page:employee-group,create');
        Route::get('/edit/{id?}', 'EmployeeGroup@edit')->name('employee-group.edit')->middleware('block-page:employee-group,update');
        Route::post('/update', 'EmployeeGroup@update')->name('employee-group.update')->middleware('block-page:employee-group,update');
        Route::get('/delete/{id?}', 'EmployeeGroup@delete')->name('employee-group.delete')->middleware('block-page:employee-group,delete');
    });

    Route::get('/logout', 'Auth\Auth@logout')->name('auth.logout');
});

/*
 * middleware guest
 */
Route::middleware(['guest'])->group(function () {

    /*
     * auth module
     */
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'Auth@login')->name('auth.login');
        Route::post('/do-login', 'Auth@doLogin')->name('auth.doLogin');
    });
});


/*
 * route for refresh captcha
 */
Route::get('/refresh-captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') { return $captcha->src($config);})->name('refreshCaptcha');

