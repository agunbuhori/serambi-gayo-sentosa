<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(24, 235) as $barang) {
            DB::table('satuan_barang')->insert([
                'satuan_id' => 9,
                'barang_id' => $barang
            ]);
        }
    }
}
