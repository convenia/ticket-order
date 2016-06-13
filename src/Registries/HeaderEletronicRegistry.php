<?php

namespace Convenia\TicketOrder\Registries;

use Convenia\TicketOrder\Fields\Formats\FieldC;
use Convenia\TicketOrder\Fields\Formats\FieldN;

/**
 * Class HeaderEletronicRegistry.
 */
class HeaderEletronicRegistry extends Registry
{
    protected $length = 164;

    /**
     * @var array
     */
    protected $defaultFields = [
        'registryType' => [
            'format'       => FieldC::class,
            'position'     => 1,
            'length'       => 1,
            'defaultValue' => 'T',
        ],
        'product' => [
            'format'   => FieldC::class,
            'position' => 2,
            'length'   => 1,
        ],
        'fixed' => [
            'format'       => FieldC::class,
            'position'     => 3,
            'length'       => 2,
            'defaultValue' => '02',
        ],
        'type' => [
            'format'       => FieldC::class,
            'position'     => 5,
            'length'       => 1,
            'defaultValue' => '0',
        ],
        'product_2' => [
            'format'   => FieldC::class,
            'position' => 6,
            'length'   => 1,
        ],
        'contractNumber' => [
            'format'   => FieldN::class,
            'position' => 7,
            'length'   => 10,
        ],
        'companyName' => [
            'format'   => FieldC::class,
            'position' => 17,
            'length'   => 24,
        ],
        'private1' => [
            'format'       => FieldC::class,
            'position'     => 41,
            'length'       => 6,
            'defaultValue' => ' ',
        ],
        'orderDate' => [
            'format'   => FieldN::class,
            'position' => 47,
            'length'   => 8,
            'rules'    => [
                'required',
                'date:Ymd',
            ],
        ],
        'creditDate' => [
            'format'   => FieldN::class,
            'position' => 55,
            'length'   => 8,
            'rules'    => [
                'required',
                'date:Ymd',
            ],
        ],
        'orderType' => [
            'format'       => FieldC::class,
            'position'     => 63,
            'length'       => 1,
            'defaultValue' => 'C',
        ],
        'private2' => [
            'format'       => FieldC::class,
            'position'     => 64,
            'length'       => 16,
            'defaultValue' => ' ',
        ],
        'creditMonth' => [
            'format'   => FieldC::class,
            'position' => 80,
            'length'   => 2,
            'rules'    => [
                'required',
            ],
        ],
        'private3' => [
            'format'       => FieldC::class,
            'position'     => 82,
            'length'       => 19,
            'defaultValue' => ' ',
        ],
        'layoutType' => [
            'format'       => FieldC::class,
            'position'     => 101,
            'length'       => 2,
            'defaultValue' => '04',
        ],
        'cardType' => [
            'format'   => FieldC::class,
            'position' => 103,
            'length'   => 2,
            'rules'    => [
                'required',
            ],
        ],
        'private4' => [
            'format'       => FieldC::class,
            'position'     => 105,
            'length'       => 48,
            'defaultValue' => ' ',
        ],
        'origin' => [
            'format'       => FieldC::class,
            'position'     => 153,
            'length'       => 6,
            'defaultValue' => 'SUP',
        ],
        'registryId' => [
            'format'   => FieldN::class,
            'position' => 159,
            'length'   => 6,
            'rules'    => [
                'required',
            ],
        ],
    ];
}
