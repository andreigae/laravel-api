<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryBuyerController extends ApiController
{


    // Obtener los compradores de una categoria
    // 1. Obtener los productos de la categoria que tienen transacciones
    // 2. Obtener las transacciones de los productos con su comprador
    // 3. Crear un array con los compradores de las transacciones
    // 4. Obtener los compradores unicos (solo quedarse con los registros que no se repiten)
    // 5. Obtener los compradores con valores reales (sin espacios vacios)

    public function index(Category $category)
    {
        $buyers = $category->products()
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
