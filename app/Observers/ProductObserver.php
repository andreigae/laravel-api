<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        //
    }
  
    public function updated(Product $product): void
    {

        // Si la cantidad de productos es igual a 0 y el producto esta disponible,
        // cambia el estado del producto a no disponible
        if ($product->quantity == 0 && $product->estaDisponible()) {
            $product->status = Product::PRODUCTO_NO_DISPONIBLE;

            $product->save();
        }
      
    }

    public function deleted(Product $product): void
    {
        //
    }
   
    public function restored(Product $product): void
    {
        //
    }

    public function forceDeleted(Product $product): void
    {
        //
    }
}
