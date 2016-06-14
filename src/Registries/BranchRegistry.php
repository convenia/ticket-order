<?php

namespace Convenia\TicketOrder\Registries;

use Convenia\TicketOrder\Fields\Formats\FieldC;
use Convenia\TicketOrder\Fields\Formats\FieldN;

/**
 * Class BranchRegistry.
 */
class BranchRegistry extends Registry
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
            'defaultValue' => 1,
        ],
        'product' => [
            'format'   => FieldC::class,
            'position' => 2,
            'length'   => 1,
            'rules'    => [
                'required',
            ],
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
            'defaultValue' => '2',
        ],
        'companyName' => [
            'format'   => FieldC::class,
            'position' => 6,
            'length'   => 26,
            'rules'    => [
                'required',
            ],
        ],
        'addressType' => [
            'format'   => FieldC::class,
            'position' => 32,
            'length'   => 4,
            'rules'    => [
                'required',
            ],
        ],
        'address' => [
            'format'   => FieldC::class,
            'position' => 36,
            'length'   => 30,
            'rules'    => [
                'required',
            ],
        ],
        'addressNumber' => [
            'format'   => FieldC::class,
            'position' => 66,
            'length'   => 6,
            'rules'    => [
                'required',
            ],
        ],
        'address2' => [
            'format'       => FieldC::class,
            'position'     => 72,
            'length'       => 10,
            'defaultValue' => ' ',
        ],
        'city' => [
            'format'   => FieldC::class,
            'position' => 82,
            'length'   => 25,
            'rules'    => [
                'required',
            ],
        ],
        'district' => [
            'format'   => FieldC::class,
            'position' => 107,
            'length'   => 15,
            'rules'    => [
                'required',
            ],
        ],
        'areaCodeBase' => [
            'format'   => FieldN::class,
            'position' => 122,
            'length'   => 5,
            'rules'    => [
                'required',
            ],
        ],
        'state' => [
            'format'   => FieldC::class,
            'position' => 127,
            'length'   => 2,
            'rules'    => [
                'required',
            ],
        ],
        'contactPerson' => [
            'format'   => FieldC::class,
            'position' => 129,
            'length'   => 20,
            'rules'    => [
                'required',
            ],
        ],
        'areaCode' => [
            'format'   => FieldN::class,
            'position' => 149,
            'length'   => 3,
            'rules'    => [
                'required',
            ],
        ],
        'private' => [
            'format'       => FieldC::class,
            'position'     => 152,
            'length'       => 7,
            'defaultValue' => ' ',
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
