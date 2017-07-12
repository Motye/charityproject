<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Moloquent\Eloquent\Model as Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 * @property-read mixed
 *                    $id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[]
 *                $notifications
 * @mixin \Eloquent
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmed',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasHighBid()
    {
        $myBid = 0;

        if ($this->numberOfBids() > 0) {
            $myBid = Bid::where('bidder', $this->id)->max('bid');
        }

        return $myBid == Bid::getHighBid() ? true : false;
    }

    public function numberOfBids()
    {
        return count(Bid::where('bidder', $this->id)->get());
    }
}
