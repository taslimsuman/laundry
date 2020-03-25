<?php


Auth::routes();

Route::get('/cache-clear',function(){

	Artisan::call('cache:clear');
	//Artisan::call('session:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');

	return 'clear';

});

// admin routes
Route::group(['middleware' => 'prevent-back-history'],function(){


Route::get('/',function(){

	return view('home');

});

//Dashboard
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/home', 'HomeController@dashboard');
Route::get('/settings', 'HomeController@settings');
Route::post('/settings', 'HomeController@update');


// User manage
Route::get('/users','UserController@index');
Route::get('/getusers','UserController@getUsers');
Route::post('/user','UserController@store');
Route::get('/user/edit/{id}','UserController@edit');
Route::post('/user/update/{id}','UserController@update');
Route::get('/user/delete/{id}','UserController@delete');

//Profile
Route::get('/change_password','ProfileController@change_password');
Route::post('/change_password','ProfileController@changePassword');

//Invoice contrller

Route::get('/invoices/{status}','InvoiceController@invoices');
Route::get('/invoice/create','InvoiceController@add');
Route::post('/invoice/store','InvoiceController@store');
Route::get('/invoice/{id}','InvoiceController@show');
Route::get('/invoice/update/{id}','InvoiceController@edit');
Route::post('/invoice/update/{id}','InvoiceController@update');
Route::get('/invoice/delete/{id}','InvoiceController@delete');


// Payment
Route::post('/invoice/payment/{id}','PaymentController@pay');



Route::get('/get_items','ItemController@get_items');

//Item manager
Route::get('/items','ItemController@index');
Route::post('/item','ItemController@store');
Route::get('/item/edit/{id}','ItemController@edit');
Route::post('/item/update/{id}','ItemController@update');
Route::get('/item/delete/{id}','ItemController@delete');


});
// end back history