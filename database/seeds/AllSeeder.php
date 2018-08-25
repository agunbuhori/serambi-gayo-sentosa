<?php

use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(84, 102) as $fuselink) {
        	foreach (range(1, 8) as $kategori) {
        		DB::table('kategori_barang')->insert([
        			'barang_id' => $fuselink,
        			'kategori_id' => $kategori
        		]);
        	}
        }
    }
}
