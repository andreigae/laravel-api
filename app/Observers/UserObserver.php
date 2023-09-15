<?php

namespace App\Observers;

use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;


class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        retry(5, function() use ($user) {
            Mail::to($user)->send(new UserCreated($user));
        }, 500);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if(!$user->verification_token == null){
            retry(5, function() use ($user) {
                Mail::to($user)->send(new UserMailChanged($user));
            }, 500);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
