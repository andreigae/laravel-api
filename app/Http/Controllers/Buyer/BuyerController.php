<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
{
    // Get all buyers
    public function index()
    {
        $compradores = Buyer::has('transactions')->get();

        return $this->showAll($compradores);
    }

    // Show a specific buyer
    public function show($id)
    {
        $comprador = Buyer::has('transactions')->findOrFail($id);

        return $this->showOne($comprador);
    }
}
