<?php

namespace App\Http\Controllers\Api;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function material()
    {
    	$materials = DB::table('material')->get();

    	return $materials;
    }
}
