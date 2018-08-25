<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SatuanMaterialController extends Controller
{
    public function index()
    {
    	return view('satuan_material.index');
    }
}
