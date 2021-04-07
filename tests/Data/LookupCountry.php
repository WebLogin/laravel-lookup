<?php
namespace WebLogin\LaravelLookup\Tests\Data;

use WebLogin\LaravelLookup\Lookup;


class LookupCountry extends Lookup
{

    public $key;
    public $name;


    protected static function getItems()
    {
        return [
            ['key' => "can",         'name' => "Canada"],
            ['key' => "deu",         'name' => "Germany"],
            ['key' => "esp",         'name' => "Spain"],
            ['key' => "fra",         'name' => "France"],
            ['key' => "gbr",         'name' => "United Kingdom"],
            ['key' => "ita",         'name' => "Italy"],
            ['key' => "usa",         'name' => "United States of America"],
        ];
    }


    public function flag()
    {
        return "images/countries/" . $this->key . ".jpg";
    }

}
