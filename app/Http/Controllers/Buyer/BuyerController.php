<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Buyer;


class BuyerController extends Controller
{
    // Get all buyers
    public function index()
    {
        $compradores = Buyer::has('transactions')->get();

        return response()->json(['data' => $compradores], 200);
    }

    // Show a specific buyer
    public function show($id)
    {
        $comprador = Buyer::has('transactions')->findOrFail($id);

        return response()->json(['data' => $comprador], 200);
    }
}
