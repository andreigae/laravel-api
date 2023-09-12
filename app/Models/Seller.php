<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    // El vendedor tiene muchos productos y se accede a todos ellos con el método products
    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
