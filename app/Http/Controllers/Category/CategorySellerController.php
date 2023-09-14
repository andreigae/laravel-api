<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategorySellerController extends ApiController
{
    public function index(Category $category)
    {
        // Obtener los vendedores de una categoria
        // 1. Obtener los productos de la categoria
        // 2. Obtener todos los vendedores relacionados en una sola consulta con with sellers
        // 3. Crear un array con los vendedores de los productos
        // 4. Obtener los vendedores unicos (solo quedarse con los registros que no se repiten)
        // 5. Obtener los vendedores con valores reales (sin espacios vacios)

        $sellers = $category->products()
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique()
            ->values();

        return $this->showAll($sellers);
    }
}
