<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Scopes\SellerScope;

class Seller extends Model
{
    use HasFactory;

    protected $table = "users";

    protected static function boot()
	{
		parent::boot();

		static::addGlobalScope(new SellerScope);
	}

    
    // El vendedor tiene muchos productos y se accede a todos ellos con el método products
    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
