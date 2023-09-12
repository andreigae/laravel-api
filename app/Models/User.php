<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false';
    
    protected $table = 'users';
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];



    // Mutadores y Accesores (Sirven para cambiar el valor de un atributo antes de insertarlo en la base de datos o antes de mostrarlo)

    // Cambiar el valor de name a minusculas antes de insertarlo en la base de datos
    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }

    // Cambiar el valor de name a mayusculas antes de mostrarlo
    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }

    // Cambiar el valor de email a minusculas antes de insertarlo en la base de datos
    public function setEmailAttribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function esVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function esAdministrador()
    {
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generarVerificationToken()
    {
        return Str::random(40);
    }
}
