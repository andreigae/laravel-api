<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerBuyerController extends ApiController
{
    public function index(Seller $seller)
    {
        // Obtener los compradores de un vendedor
        // 1. Obtener los productos de un vendedor
        // 2. Obtener las transacciones de los productos
        // 3. Obtener los compradores de las transacciones
        // 4. Crear un array con los compradores
        // 5. unique('id') para que no se repitan los compradores

        $buyers = $seller->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique()
            ->values();

        return $this->showAll($buyers);
    }
}
