<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerSellerController extends ApiController
{
    public function index(Buyer $buyer)
    {

        // Obtener los vendedores al que el usuario ha comprado, para ello:
        // 1. Obtener las transacciones del comprador
        // 2. Obtener los productos de esas transacciones (with(product.seller) y get)
        // 3. Crear un array con los vendedores de los productos
        // 4. Obtener los vendedores unicos (solo quedarse con los registros que no se repiten)
        // 5. Obtener los vendedores con valores reales (sin espacios vacios)

        $sellers = $buyer->transactions()->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id')
            ->values();

        return $this->showAll($sellers);
    }
}
