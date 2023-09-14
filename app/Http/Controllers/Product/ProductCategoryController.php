<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductCategoryController extends ApiController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Category $category)
    {
        // sync, attach, syncWithoutDetaching
        // sync -> reemplaza la lista de categorias por la que se envia
        // attach -> agrega una categoria a la lista de categorias
        // syncWithoutDetaching -> agrega una categoria a la lista de categorias, pero si ya existe no la agrega

        $product->categories()->syncWithoutDetaching([$category->id]);

        return $this->showAll($product->categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
