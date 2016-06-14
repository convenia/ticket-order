<?php

namespace Convenia\TicketOrder\Registries;

use Convenia\TicketOrder\Fields\Formats\FieldC;
use Convenia\TicketOrder\Fields\Formats\FieldCHeader;
use Convenia\TicketOrder\Fields\Formats\FieldN;

/**
 * Class HeaderRegistry.
 */
class HeaderRegistry extends Registry
{
    protected $length = 164;

    /**
     * @var array
     */
    protected $defaultFields = [
        'registryType' => [
            'format'       => FieldC::class,
            'position'     => 1,
            'length'       => 5,
            'defaultValue' => 'LSUP5',
        ],
        'requesterUser' => [
            'format'   => FieldC::class,
            'position' => 6,
            'length'   => 8,
            'rules'    => [
                'required',
            ],
        ],
        'private1' => [
            'format'       => FieldC::class,
            'position'     => 14,
            'length'       => 11,
            'defaultValue' => ' ',
        ],
        'orderDate' => [
            'format'   => FieldN::class,
            'position' => 25,
            'length'   => 8,
            'rules'    => [
                'required',
                'date:Ymd',
            ],
        ],
        'orderTime' => [
            'format'   => FieldCHeader::class,
            'position' => 33,
            'length'   => 8,
            'rules'    => [
                'required',
                'time:H.i.s',
            ],
        ],
        'private2' => [
            'format'       => FieldCHeader::class,
            'position'     => 41,
            'length'       => 17,
            'defaultValue' => 'LAYOUT-16/06/2014',
        ],
        'private3' => [
            'format'       => FieldC::class,
            'position'     => 58,
            'length'       => 107,
            'defaultValue' => ' ',
        ],
    ];
}
