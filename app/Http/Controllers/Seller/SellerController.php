<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;

class SellerController extends Controller
{

    


    


    public function index()
    {
        $vendedores = Seller::has('products')->get();

        return response()->json(['data' => $vendedores], 200);
    }

    public function show($id)
    {
        //
    }
}

