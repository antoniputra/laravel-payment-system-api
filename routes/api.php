<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('send-sample-mail', 'Api\SendSampleMailController');

Route::get('coba', 'Api\AuthController@coba');
// Route::post('login', 'Api\AuthController@login')->name('login');
// Route::post('register', 'Api\AuthController@register')->name('register');
// Route::post('logout', 'Api\AuthController@logout')->name('login');

Route::resource('employee', 'Api\EmployeeController')->except([
    'create', 'edit'
]);

Route::get('employee/{employeeId}/salary', 'Api\SalaryController@index')->name('employee.salary.index');
Route::post('employee/{employeeId}/salary', 'Api\SalaryController@store')->name('employee.salary.store');
Route::get('employee/{employeeId}/salary/{salaryId}', 'Api\SalaryController@show')->name('employee.salary.show');
Route::put('employee/{employeeId}/salary/{salaryId}', 'Api\SalaryController@update')->name('employee.salary.update');
Route::delete('employee/{employeeId}/salary/{salaryId}', 'Api\SalaryController@destroy')->name('employee.salary.destroy');