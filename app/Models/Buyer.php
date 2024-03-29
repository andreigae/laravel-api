<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\BuyerScope;


class Buyer extends Model
{
    use HasFactory;

    protected $table = "users";


    protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new BuyerScope);
	}



    // El comprador tiene muchas transacciones y se accede a todas ellas con el método transactions
    // hasMany is used in a One To Many relationship 
    // while belongsToMany refers to a Many To Many relationship.
    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }
}
