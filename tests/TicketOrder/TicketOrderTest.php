<?php

namespace Convenia\TicketOrder\Tests;
use Convenia\TicketOrder\TicketOrder;

/**
 * Class TicketOrderTest.
 */
class TicketOrderTest extends BaseTest
{
    public function test_generate()
    {
        $ticketOrder = new TicketOrder(
            [
                'requesterUser' => 'TICKET',
                'orderDate' => '20100120',
                'orderTime' => '13.30.39',
            ]
        );

        $ticketOrder->typeAlimentacao();
        print_r($ticketOrder->header->getField('requesterUser')->getValue());exit;
    }
}
