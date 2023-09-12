<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        
        $cantidadUsuarios = 200;
        $cantidadCategorias = 30;
        $cantidadProductos = 100;
        $cantidadTransacciones = 100;

        
        User::factory($cantidadUsuarios)->create();
        Category::factory($cantidadCategorias)->create();
    
        Product::factory($cantidadProductos)->create()->each(
            function($producto){
               // pluck() devuelve un array con los id de las categorías
				$categorias = Category::all()->random(mt_rand(1, 5))->pluck('id');
                
                $producto->categories()->attach($categorias);
            }
        );
        
        Transaction::factory($cantidadTransacciones)->create();
    }
}
