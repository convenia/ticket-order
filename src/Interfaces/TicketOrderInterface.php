<?php

namespace Convenia\TicketOrder\Interfaces;

/**
 * Interface TicketOrderInterface.
 */
interface TicketOrderInterface
{
    /**
     * Generate the ticket orders file.
     *
     * @return string
     */
    public function generate();
}
