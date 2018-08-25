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
    return view('welcome');
});

Route::get('/admin/relasi-satuan-material', 'SatuanMaterialController@index');

Route::post('/admin/add_barang_bawang_jadi', 'AdminBarangBawangJadiController@store');