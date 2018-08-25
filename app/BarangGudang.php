<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangGudang extends Model
{
    protected $table = 'barang_gudang';

    public function satuans()
    {
    	return $this->hasMany(SatuanBarang::class, 'id', 'barang_id');
    }
}
