<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
	
	protected $dates = ['deleted_at'];

    protected $fillable = [
    	'name',
    	'description',
    ];

    protected $hidden = [
        'pivot'
    ];

    // hasMany is used in a One To Many relationship (Un comprador tiene muchas transacciones)
    // while belongsToMany refers to a Many To Many relationship. (Una categoría puede tener muchos productos, y un producto puede tener muchas categorías)
    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

}
