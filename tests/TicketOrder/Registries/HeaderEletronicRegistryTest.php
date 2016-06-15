<?php

namespace Convenia\TicketOrder\Tests\Registries;

use Convenia\TicketOrder\Registries\HeaderEletronicRegistry;
use Convenia\TicketOrder\Tests\BaseTest;

/**
 * Class HeaderEletronicRegistryTest.
 */
class HeaderEletronicRegistryTest extends BaseTest
{
    /**
     * @expectedException \Convenia\TicketOrder\Exceptions\FieldNotExistsException
     */
    public function test_field_not_exists()
    {
        new HeaderEletronicRegistry(
            [
                'invalid_field' => true,
            ]
        );
    }

    public function test_complete_fields_product_a()
    {
        $eletronicHeader = new HeaderEletronicRegistry(
            [
                'product' => 'A',
                'product2' => 'A',
                'contractNumber' => '1234567890',
                'companyName' => 'NOME DE SUA EMPRESA',
                'orderDate' => '20100120',
                'creditDate' => '20100130',
                'creditMonth' => '1',
                'cardType' => '33',
                'registryId' => '1', // For tests only
            ]
        );

        $expected = 'TA020A1234567890NOME DE SUA EMPRESA           2010012020100130C                1                    0433                                                SUP   000001';

        $this->assertEquals($expected, (string) $eletronicHeader);
    }

    public function test_complete_fields_product_r()
    {
        $eletronicHeader = new HeaderEletronicRegistry(
            [
                'product' => 'R',
                'product2' => 'R',
                'contractNumber' => '1234567890',
                'companyName' => 'NOME DE SUA EMPRESA',
                'orderDate' => '20100120',
                'creditDate' => '20100130',
                'creditMonth' => '1',
                'cardType' => '33',
                'registryId' => '1', // For tests only
            ]
        );

        $expected = 'TR020R1234567890NOME DE SUA EMPRESA           2010012020100130C                1                    0433                                                SUP   000001';

        $this->assertEquals($expected, (string) $eletronicHeader);
    }
}
