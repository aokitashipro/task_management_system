<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/tasks/index', 'TasksController@index')->name('tasks.index') ;

Route::get('/tasks/link', 'TasksController@link')->name('tasks.link') ;

Route::get('/tasks/test', 'TasksController@test')->name('tasks.test') ;

Route::get('/tasks/setting', 'SettingsController@index')->name('tasks.setting') ;


Route::get('/tasks/ajax_test/{testcode}', 'TasksController@ajax_test')->name('tasks.ajax_test') ;

Route::post('/tasks/store','TasksController@store')->name('tasks.store');

Route::post('/tasks/test_store','TasksController@test_store')->name('tasks.test_store');

Route::post('/tasks/history_store','HistoriesController@history_store')->name('tasks.history_store');


Route::post('/tasks/setting_customer_store','SettingsController@setting_customer_store')->name('tasks.setting_customer_store');

Route::post('/tasks/setting_category_store','SettingsController@setting_category_store')->name('tasks.setting_category_store');

Route::post('/tasks/setting_member_store','SettingsController@setting_member_store')->name('tasks.setting_member_store');


Route::get('/tasks/complete_list', 'TasksController@complete_list')->name('tasks.complete_list') ;
Route::get('/tasks/history', 'HistoriesController@history')->name('tasks.history') ;

Route::get('tasks/create','TasksController@create')->name('tasks.create');

Route::get('tasks/history_create','HistoriesController@history_create')->name('tasks.history_create');


Route::get('tasks/setting_customer_create','SettingsController@setting_customer_create')->name('tasks.setting_customer_create');

Route::get('tasks/setting_category_create','SettingsController@setting_category_create')->name('tasks.setting_category_create');

Route::get('tasks/setting_member_create','SettingsController@setting_member_create')->name('tasks.setting_member_create');



Route::get('tasks/show/{id}', 'TasksController@show')->name('tasks.show');


Route::get('tasks/setting_customer_update/{id}', 'SettingsController@setting_customer_update')->name('tasks.setting_customer_update');

Route::get('tasks/setting_category_update/{id}', 'SettingsController@setting_category_update')->name('tasks.setting_category_update');

Route::get('tasks/setting_member_update/{id}', 'SettingsController@setting_member_update')->name('tasks.setting_member_update');



Route::get('tasks/edit_full/{id}', 'TasksController@edit_full')->name('tasks.edit_full');
Route::post('tasks/update_full/{id}', 'TasksController@update_full')->name('tasks.update_full');


Route::delete('tasks/destroy/{id}', 'TasksController@destroy')->name('tasks.destroy');

Route::get('tasks/edit/{id}', 'TasksController@edit')->name('tasks.edit');

Route::get('tasks/edit_report/{id}', 'TasksController@edit_report')->name('tasks.edit_report');

Route::get('tasks/change_t/{id}', 'TasksController@change_t')->name('tasks.change_t');
Route::get('tasks/change_priority/{id}', 'TasksController@change_priority')->name('tasks.change_priority');


Route::post('tasks/update/{id}', 'TasksController@update')->name('tasks.update');
Route::post('tasks/update_report/{id}', 'TasksController@update_report')->name('tasks.update_report');

Route::post('tasks/change_upload_t/{id}', 'TasksController@change_upload_t')->name('tasks.change_upload_t');


Route::post('tasks/setting_customer_changed/{id}', 'SettingsController@setting_customer_changed')->name('tasks.setting_customer_chnaged');

Route::post('tasks/setting_category_changed/{id}', 'SettingsController@setting_category_changed')->name('tasks.setting_category_chnaged');

Route::post('tasks/setting_member_changed/{id}', 'SettingsController@setting_member_changed')->name('tasks.setting_member_chnaged');


Route::get('tasks/excel', 'TasksController@excel')->name('tasks.excel');
Route::get('tasks/{id}', 'TasksController@show')->name('tasks.excel-id');


Route::auth();

Route::get('/home', 'HomeController@index');
