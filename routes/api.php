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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
	Route::get('material', 'MaterialController@material');

	Route::get('anak_barang/{barang_id}', function ($barang_id) {
		$barangs = DB::table('barang')->where('parent_id', $barang_id)->get();
		$json_barang = [];
		foreach ($barangs as $barang)
			$json_barang[] = ['id' => $barang->id, 'value' => $barang->nama_barang];

		return $json_barang;
	});

	Route::get('kategori/{barang_id}', function ($barang_id) {
		$kategoris = DB::table('kategori')
						->join('kategori_barang', 'kategori_barang.kategori_id', '=', 'kategori.id')
						->where('kategori_barang.barang_id', $barang_id)
						->orderBy('kategori.nama_kategori', 'asc')
						->get();
		
		$json_kategori = [];
		
		foreach ($kategoris as $kategori)
			$json_kategori[] = ['id' => $kategori->id, 'value' => $kategori->nama_kategori];

		return $json_kategori;
	});

	Route::get('satuan/{barang_id}', function ($barang_id) {
		$satuans = DB::table('satuan')
						->join('satuan_barang', 'satuan_barang.satuan_id', '=', 'satuan.id')
						->where('satuan_barang.barang_id', $barang_id)
						->orderBy('satuan.nama_satuan', 'asc')
						->get();
		
		$json_satuan = [];
		
		foreach ($satuans as $satuan)
			$json_satuan[] = ['id' => $satuan->id, 'value' => $satuan->nama_satuan];

		return $json_satuan;
	});
});