<?php

namespace Convenia\TicketOrder\Interfaces;

/**
 * Interface FieldInterface.
 */
interface FieldInterface
{
    /**
     * Return the formatted field.
     *
     * @return string
     */
    public function format();

    /**
     * Return the formatted value.
     *
     * @return string
     */
    public function getValue();
}
