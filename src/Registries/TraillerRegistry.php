<?php

namespace Convenia\TicketOrder\Registries;

use Convenia\TicketOrder\Fields\Formats\FieldC;
use Convenia\TicketOrder\Fields\Formats\FieldN;

/**
 * Class TraillerRegistry.
 */
class TraillerRegistry extends Registry
{
    protected $length = 164;

    /**
     * @var array
     */
    protected $defaultFields = [
        'registryType' => [
            'format' => FieldN::class,
            'position' => 1,
            'length' => 1,
            'defaultValue' => 'T',
        ],
        'product' => [
            'format' => FieldC::class,
            'position' => 2,
            'length' => 1,
            'rules' => [
                'required',
            ],
        ],
        'fixed' => [
            'format' => FieldC::class,
            'position' => 3,
            'length' => 2,
            'defaultValue' => '02',
        ],
        'type' => [
            'format' => FieldC::class,
            'position' => 5,
            'length' => 1,
            'defaultValue' => '9',
        ],
        'employeeRegTotals' => [
            'format' => FieldN::class,
            'position' => 6,
            'length' => 8,
            'rules' => [
                'required',
            ],
        ],
        'orderTotal' => [
            'format' => FieldN::class,
            'position' => 14,
            'length' => 14,
            'rules' => [
                'required',
            ],
        ],
        'private1' => [
            'format' => FieldC::class,
            'position' => 28,
            'length' => 131,
            'defaultValue' => ' ',
        ],
        'registryId' => [
            'format' => FieldN::class,
            'position' => 395,
            'length' => 6,
            'rules' => [
                'required',
            ],
        ],
    ];
}
