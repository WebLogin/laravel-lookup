<?php
namespace WebLogin\LaravelLookup\Tests;


class LookupCastTest extends TestCase
{

    /** @test */
    public function getting_expected_value()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->country = 'fra';
        $this->assertEquals("France", $addressModel->country->name);
    }


    /** @test */
    public function set_method_accept_lookup()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->country = Data\LookupCountry::find('fra');
        $this->assertEquals('fra', $addressModel->getAttributes()['country']);
    }


    /** @test */
    public function getting_null_when_setting_invalid_value()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->country = 'xxx';
        $this->assertNull($addressModel->country);
        $this->assertEquals('xxx', $addressModel->getAttributes()['country']);
    }


    /** @test */
    public function setting_empty_value_return_null()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->country = null;
        $this->assertNull($addressModel->country);
        $this->assertNull($addressModel->getAttributes()['country']);

        $addressModel->country = '';
        $this->assertNull($addressModel->country);
        $this->assertNull($addressModel->getAttributes()['country']);

        $addressModel->country = '   ';
        $this->assertNull($addressModel->country);
        $this->assertNull($addressModel->getAttributes()['country']);
    }

}
