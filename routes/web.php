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

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/category', 'HomeController@category');

Route::get('/editcategory/{id}', 'HomeController@editcategory');

Route::get('/deletecategory/{id}', 'HomeController@deletecategory');

Route::get('/customeredit/{id}', 'HomeController@customeredit');

Route::get('/customerdelete/{id}', 'HomeController@customerdelete');

Route::get('/addcategory', 'HomeController@addcategory');

Route::post('/entercategory', 'HomeController@entercategory');

Route::post('/categoryedit', 'HomeController@categoryedit');

Route::get('/customer', 'HomeController@customer');

Route::get('/addcustomer', 'HomeController@addcustomer');

Route::post('/entercustomer', 'HomeController@entercustomer');

Route::post('/updatecustomer', 'HomeController@updatecustomer');

Route::get('/stock', 'HomeController@stock');

Route::get('/addstock', 'HomeController@addstock');

Route::get('/enterstock', 'HomeController@enterstock');

Route::post('/searchcustomer', 'HomeController@searchcustomer');

Route::get('/live_search', 'HomeController@action')->name('live_search');

Route::post('/stockenter', 'HomeController@stockenter');

Route::get('/payment', 'HomeController@payment');

Route::post('/addpayment', 'HomeController@addpayment');

Route::post('/searchtag', 'HomeController@searchtag');

Route::post('/searchclothes', 'HomeController@searchclothes');

Route::post('/searchincome', 'HomeController@searchincome');

Route::post('/searchclothesout', 'HomeController@searchclothesout');

Route::post('/registerworker', 'HomeController@registerworker');

Route::post('/updateworker', 'HomeController@updateworker');

Route::get('/receipt', 'HomeController@receipt');

Route::get('/breakdown/{id}', 'HomeController@breakdown');

Route::get('/returnstock', 'HomeController@returnstock');

Route::get('/chkreturn', 'HomeController@chkreturn');

Route::get('/confirmbalance', 'HomeController@confirmbalance');

Route::get('/printreturn', 'HomeController@printreturn');

Route::get('/clothesin', 'HomeController@clothesin');

Route::get('/allclothes', 'HomeController@allclothes');

Route::get('/income', 'HomeController@income');

Route::get('/allincome', 'HomeController@allincome');

Route::get('/clothesout', 'HomeController@clothesout');

Route::get('/allclothesout', 'HomeController@allclothesout');

Route::get('/worker', 'HomeController@worker');

Route::get('/addworker', 'HomeController@addworker');

Route::get('/editworker/{id}', 'HomeController@editworker');

Route::get('/deleteworker/{id}', 'HomeController@deleteworker');

Route::get('/services', 'HomeController@service');

Route::get('/addservice', 'HomeController@addservice');

Route::post('/enterservice', 'HomeController@enterservice');

Route::post('/updateservice', 'HomeController@updateservice');

Route::post('/aditionalservice', 'HomeController@aditionalservice');

Route::get('/editservices/{id}', 'HomeController@editservice');

Route::get('/deleteservice/{id}', 'HomeController@deleteservice');

Route::get('/addinfo', 'HomeController@addinfo');

Route::get('/tag', 'HomeController@tag');

Route::get('/tagprint', 'HomeController@tagprint');

Route::post('/printtag', 'HomeController@printtag');

Route::get('/live_search2', 'HomeController@action2')->name('live_search2');

Route::get('/color', 'HomeController@color');

Route::get('/addcolor', 'HomeController@addcolor');

Route::get('/editcolor/{id}', 'HomeController@editcolor');

Route::get('/deletecolor/{id}', 'HomeController@deletecolor');

Route::post('/entercolor', 'HomeController@entercolor');

Route::post('/updatecolor', 'HomeController@updatecolor');

Route::post('/inputcolor', 'HomeController@inputcolor');

Route::get('/selectcolor', 'HomeController@selectcolor');




