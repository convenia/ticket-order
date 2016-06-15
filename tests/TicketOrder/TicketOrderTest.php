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
                        'companyName'    => 'NOME DE SUA EMPRESA',
                        'orderDate'      => '20100120',
                        'creditDate'     => '20100130',
                        'creditMonth'    => '1',
                    ])
                    ->deliverySetup([
                        'companyName'   => 'Ticket LTDA.',
                        'addressType'   => 'AL',
                        'address'       => 'Rua Teste',
                        'addressNumber' => '1',
                        'address2'      => 'AP 10',
                        'city'          => 'São Paulo',
                        'district'      => 'Ipiranga',
                        'state'         => 'SP',
                        'areaCode'      => '00000000',
                        'contactPerson' => 'Fulano',
                    ])
                    ->addEmployee([
                        'department' => 'opa',
                        'cpf'        => '356.765.698-83',
                        'birthDate'  => '08011972',
                        'branchName' => 'Ticket LTDA.',
                        'monthValue' => '10000',
                        'name'       => 'Ciclano',
                    ])
                    ->generate();
    }
}
