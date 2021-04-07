<?php
namespace WebLogin\LaravelLookup\Tests;


class LookupCollectionTest extends TestCase
{

    /** @test */
    public function find_method_accept_one_or_multiple_keys()
    {
        $countryFra = Data\LookupCountry::find('fra');
        $this->assertEquals("France", $countryFra->name);

        $countriesAndIta = Data\LookupCountry::find(['fra', 'ita']);
        $this->assertEquals(2, count($countriesAndIta));

        $countriesWrong = Data\LookupCountry::find(['XXX', 'ZZZ']);
        $this->assertEquals(0, count($countriesWrong));
    }

}
