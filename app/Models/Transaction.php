<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'product_id',
    ];

    // Una transacción pertenece a un comprador y se accede a él con el método buyer
    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }

    // Una transacción pertenece a un producto y se accede a él con el método product
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
