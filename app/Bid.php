<?php

namespace App;

use Moloquent\Eloquent\Model as Model;

class Bid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bid',
        'bidder'
    ];

    public static function getHighBid()
    {
        $highBid = self::max('bid');

        return is_null($highBid) ? config('bids.min') : $highBid;
    }

    public static function getHighBidOwner()
    {
        $highBid = self::orderBy('bid', 'desc')->first();

        return is_null($highBid) ? null : $highBid->bidder;
    }

}
