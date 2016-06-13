<?php

namespace Convenia\TicketOrder\Fields\Formats;

use Convenia\TicketOrder\Fields\Field;

/**
 * Class FieldCHeader.
 */
class FieldCHeader extends Field
{
    /**
     * Return the formatted field.
     *
     * @return string
     */
    public function format()
    {
        $this->value = $this->value->toUpperCase();
        $actualLength = $this->value->length();
        $this->value = $this->value->truncate($this->getLength());

        if ($actualLength < $this->getLength()) {
            $this->value = $this->value->padRight($this->getLength());
        }

        return $this->value;
    }
}
