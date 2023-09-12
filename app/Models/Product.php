<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

	const PRODUCTO_DISPONIBLE = 'disponible';
	const PRODUCTO_NO_DISPONIBLE = 'no disponible';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id',
    ];

    public function estaDisponible()
    {
    	return $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    // El producto pertenece a un vendedor y se accede a él con el método seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // El producto tiene muchas transacciones y se accede a todas ellas con el método transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // El producto tiene muchas categorías y se accede a todas ellas con el método categories
    // a su vez, cada categoría tiene muchos productos y se accede a ellos con el método products
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


}
