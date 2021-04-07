<?php
namespace WebLogin\LaravelLookup\Tests\Data;

use WebLogin\LaravelLookup\Lookup;


class LookupColor extends Lookup
{

    public $hex;
    public $name;
    protected static $primaryKeyName = 'hex';


    protected static function getItems()
    {
        return [
            ['hex' => "000000",     'name' => "Black"],
            ['hex' => "0000FF",     'name' => "Blue"],
            ['hex' => "FF0000",     'name' => "Red"],
            ['hex' => "FFFFFF",     'name' => "White"],
        ];
    }

}
