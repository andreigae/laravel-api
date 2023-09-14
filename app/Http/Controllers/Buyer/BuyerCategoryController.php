<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerCategoryController extends ApiController
{
    public function index(Buyer $buyer)
    {

        // Obtener las categorias de los productos comprados por un comprador
        // 1. Obtener las transacciones del comprador
        // 2. Obtener los productos de esas transacciones (with(product.categories) y get)
        // 3. Crear un array con las categorias de los productos
        // 4. Obtener las categorias unicas (solo quedarse con los registros que no se repiten)
        // 5. Obtener las categorias con valores reales (sin espacios vacios)
        
        $categories = $buyer->transactions()->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($categories);
    }

}
