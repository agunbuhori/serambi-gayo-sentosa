<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    protected $table = 'satuan_barang';
    protected $primaryKey = 'id';

    public function satuan()
    {
    	return $this->belongsTo(Satuan::class);
    }
}
