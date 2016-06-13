<?php

namespace Convenia\TicketOrder\Tests\Registries;

use Convenia\TicketOrder\Registries\HeaderRegistry;
use Convenia\TicketOrder\Tests\BaseTest;

/**
 * Class HeaderRegistryTest.
 */
class HeaderRegistryTest extends BaseTest
{
    /**
     * @expectedException \Convenia\TicketOrder\Exceptions\FieldNotExistsException
     */
    public function test_field_not_exists()
    {
        new HeaderRegistry(
            [
                'invalid_field' => true
            ]
        );
    }

    public function test_complete_fields()
    {
        $eletronicHeader = new HeaderRegistry(
            [
                'requesterUser' => 'TICKET',
                'orderDate' => '20100120',
                'orderTime' => '13.30.39',
            ]
        );

        $expected = 'LSUP5TICKET             2010012013.30.39LAYOUT-16/06/2014                                                                                                           ';
        $this->assertEquals($expected, (string) $eletronicHeader);
    }
}
