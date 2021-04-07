<?php
namespace WebLogin\LaravelLookup\Tests\Data;

use WebLogin\LaravelLookup\Lookup;


class LookupState extends Lookup
{

    public $key;
    public $name;


    protected static function getItems()
    {
        return [
            ['key' => 0,     'name' => "Inactive"],
            ['key' => 1,     'name' => "Active"],
            ['key' => 2,     'name' => "Draft"],
        ];
    }

}
