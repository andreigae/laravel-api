<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerProductController extends ApiController
{
    public function index(Buyer $buyer)
    {   
        // Obten una lista de productos que el cliente ha comprado (accede a todas las transacciones y de ahi a los productos),
        // con with('product') accedemos a la relacion de la transaccion con el producto sin consultar la tabla producto por cada transaccion
        // con pluck(product) se devuelve un array con los productos 


        $products = $buyer->transactions()->with('product')
            ->get()
            ->pluck('product');

        return $this->showAll($products);
    }
}
