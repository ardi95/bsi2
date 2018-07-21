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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function () {
	Route::resource('product', 'ProductController',[
		'except' => ['show']
	]);
	Route::resource('konfirmasi', 'KonfirmasiController',[
		'only' => ['index','show','store']
	]);
	Route::get('ajaxkonfirmasi','KonfirmasiController@ajaxkonfirmasi')->name('ajaxkonfirmasi');
});

Route::group(['prefix'=>'member', 'middleware'=>['auth','role:member']], function () {
	Route::resource('cart', 'CartController',[
		'except' => ['show','edit','update']
	]);
	Route::resource('bayar', 'BayarController',[
		'only' => ['index','store','show','destroy']
	]);
	Route::post('checkout','BayarController@checkout')->name('checkout');
	Route::resource('profil', 'ProfilController',[
		'only' => ['edit','update']
	]);
});

Route::resource('productuser', 'ProductuserController',[
	'only' => ['index','show']
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('carapemesanan', 'CarapemesananController',[
	'only' => ['index']
]);

Route::resource('kontak', 'KontakController',[
	'only' => ['index']
]);