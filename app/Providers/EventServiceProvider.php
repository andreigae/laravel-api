<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;



use App\Models\Product;
use App\Observers\ProductObserver;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);

        /* OTRA FORMA DE CONSEGUIR EL MISMO RESULTADO en este archivo:
            Product::updated(function($product) {
                if ($product->quantity == 0 && $product->estaDisponible()) {
                    $product->status = Product::PRODUCTO_NO_DISPONIBLE;

                    $product->save();
                }
            });


            Tambien se puede declarar esto directamente en el modelo Product en el metodo booted, de la siguiente forma:
            class User extends Model
            {

                protected static function booted()
                {
                    static::created(function ($user) {
                        // Lógica para hacer algo con la instancia del modelo.
                    });
                }
            }

            Pero sinceramente la forma anterior es la mas limpia
         */
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
