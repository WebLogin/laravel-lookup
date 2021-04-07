<?php
namespace WebLogin\LaravelLookup\Tests\Data;

use WebLogin\LaravelLookup\LookupCast;
use Illuminate\Database\Eloquent\Model;
use WebLogin\LaravelLookup\LookupCollectionCast;


class ModelAddress extends Model
{

    protected $casts = [
        'state'     => LookupCast::class.':'.LookupState::class,
        'country'   => LookupCast::class.':'.LookupCountry::class,
        'colors'    => LookupCollectionCast::class.':'.LookupColor::class,
    ];

}
