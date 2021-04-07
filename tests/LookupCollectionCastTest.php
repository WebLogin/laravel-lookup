<?php
namespace WebLogin\LaravelLookup\Tests;


class LookupCollectionCastTest extends TestCase
{

    /** @test */
    public function get_method_skip_invalid_values()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->colors = ['FFFFFF', 'XXXXXX'];
        $this->assertEquals(1, count($addressModel->colors));
        $addressModel->colors = ['000000', 'FFFFFF'];
        $this->assertEquals(2, count($addressModel->colors));
        $this->assertEquals("Black", $addressModel->colors->first()->name);
    }


    /** @test */
    public function getting_null_when_setting_invalid_value()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->colors = ['XXX'];
        $this->assertNull($addressModel->colors);
        $this->assertEquals('["XXX"]', $addressModel->getAttributes()['colors']);
    }


    /** @test */
    public function setting_empty_value_return_null()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->colors = null;
        $this->assertNull($addressModel->colors);
        $this->assertNull($addressModel->getAttributes()['colors']);

        $addressModel->colors = '';
        $this->assertNull($addressModel->colors);
        $this->assertNull($addressModel->getAttributes()['colors']);

        $addressModel->colors = [''];
        $this->assertNull($addressModel->colors);
        $this->assertNull($addressModel->getAttributes()['colors']);

        $addressModel->colors = ['', '    '];
        $this->assertNull($addressModel->colors);
        $this->assertNull($addressModel->getAttributes()['colors']);
    }


    /** @test */
    public function set_method_accept_string_or_array_of_string_or_lookup()
    {
        $addressModel = new Data\ModelAddress();
        $addressModel->colors = 'FFFFFF';
        $tempColor1 = $addressModel->getAttributes()['colors'];
        $addressModel->colors = ['FFFFFF'];
        $tempColor2 = $addressModel->getAttributes()['colors'];
        $addressModel->colors = Data\LookupColor::find('FFFFFF');
        $tempColor3 = $addressModel->getAttributes()['colors'];

        $this->assertEquals($tempColor1, $tempColor2);
        $this->assertEquals($tempColor2, $tempColor3);
    }

}
