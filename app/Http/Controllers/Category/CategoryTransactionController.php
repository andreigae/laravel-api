<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryTransactionController extends ApiController
{
    public function index(Category $category)
    {
        // Obtener las transacciones de una categoria
        // 1. Obtener los productos de la categoria
        // 2. Obtener las transacciones de los productos 
        // 3. Crear un array con las transacciones de los productos
        // 4. collapse() -> une todos los arrays en uno solo

        $transactions = $category->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);
    }
}
