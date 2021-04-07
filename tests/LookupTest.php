<?php
namespace WebLogin\LaravelLookup\Tests;


class LookupTest extends TestCase
{

    /** @test */
    public function primary_key_can_be_a_string_or_an_int()
    {
        $lookupWithStringPk = Data\LookupCountry::first();
        $this->assertIsString($lookupWithStringPk->key);

        $lookupWithIntPk = Data\LookupState::first();
        $this->assertIsInt($lookupWithIntPk->key);
    }

}
