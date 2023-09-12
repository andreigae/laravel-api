<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Http\Controllers\ApiController;

class SellerController extends ApiController
{


    public function index()
    {
        $vendedores = Seller::has('products')->get();

        return response()->json(['data' => $vendedores], 200);
    }

    public function show($id)
    {
        $vendedor = Seller::has('products')->findOrFail($id);

        return response()->json(['data' => $vendedor], 200);
    }
}

