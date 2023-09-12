<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::has('transactions')->get();

        return response()->json(['data' => $sellers], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sellers = Seller::has('transactions')->findOrFail($id);

        return response()->json(['data' => $sellers], 200);
    }
}
