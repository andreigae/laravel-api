<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerTransactionController extends ApiController
{
    public function index(Seller $seller)
    {
        // Obtener las transacciones de un vendedor
        // 1. Obtener los productos de un vendedor que tienen transacciones
        // 2. Obtener las transacciones de los productos
        // 3. Crear un array con las transacciones
        // 4. collapse()-> para unir las colecciones en un solo array

        $transactions = $seller->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);
    }
}
