<?php

namespace Convenia\TicketOrder\Tests;

use Convenia\TicketOrder\TicketOrder;

/**
 * Class TicketOrderTest.
 */
class TicketOrderTest extends BaseTest
{
    /**
     * @expectedException \Convenia\TicketOrder\Exceptions\InvalidProductTypeException
     *
     * @throws InvalidProductTypeException
     */
    public function test_wrong_product_type()
    {
        $ticketOrder = new TicketOrder();

        $ticketOrder->setProductType('wrong');
    }

    public function test_generate()
    {
        $ticketOrder = new TicketOrder();

        $ticketOrder->typeAlimentacao()
                    ->orderSetup([
                        'contractNumber' => '1234567890',
                        'companyName' => 'NOME DE SUA EMPRESA',
                        'orderDate' => '20100120',
                        'creditDate' => '20100130',
                        'creditMonth' => '1',
                    ])
                    ->addEmployee([
                        'department' => 'opa',
                        'cpf' => '33402203871',
                        'birthDate' => '08011985',
                        'branchName' => 'opa',
                        'monthValue' => '10000',
                        'name' => 'Eduardo',
                    ])
                    ->generate();
    }
}
