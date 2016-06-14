<?php

namespace Convenia\TicketOrder\Registries;

use Convenia\TicketOrder\Fields\Formats\FieldC;
use Convenia\TicketOrder\Fields\Formats\FieldN;

/**
 * Class EmployeeRegistry.
 */
class EmployeeRegistry extends Registry
{
    protected $length = 164;

    /**
     * @var array
     */
    protected $defaultFields = [
        'registryType' => [
            'format' => FieldC::class,
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
            'defaultValue' => '3',
        ],
        'department' => [
            'format' => FieldC::class,
            'position' => 6,
            'length' => 26,
            'rules' => [
                'required',
            ],
        ],
        'cpf' => [
            'format' => FieldN::class,
            'position' => 32,
            'length' => 12,
            'rules' => [
                'required',
            ],
        ],
        'birthDate' => [
            'format' => FieldC::class,
            'position' => 44,
            'length' => 8,
            'rules' => [
                'required',
                'date:dmY',
            ],
        ],
        'private1' => [
            'format' => FieldC::class,
            'position' => 52,
            'length' => 18,
            'defaultValue' => ' ',
        ],
        'branchName' => [
            'format' => FieldC::class,
            'position' => 70,
            'length' => 26,
            'rules' => [
                'required',
            ],
        ],
        'private2' => [
            'format' => FieldN::class,
            'position' => 96,
            'length' => 5,
            'defaultValue' => '00101',
        ],
        'monthValue' => [
            'format' => FieldN::class,
            'position' => 101,
            'length' => 9,
            'rules' => [
                'required',
            ],
        ],
        'product2' => [
            'format' => FieldC::class,
            'position' => 110,
            'length' => 1,
            'rules' => [
                'required',
            ],
        ],
        'private3' => [
            'format' => FieldN::class,
            'position' => 111,
            'length' => 1,
            'defaultValue' => 'E',
        ],
        'name' => [
            'format' => FieldC::class,
            'position' => 112,
            'length' => 30,
            'rules' => [
                'required',
            ],
        ],
        'private4' => [
            'format' => FieldN::class,
            'position' => 142,
            'length' => 17,
            'defaultValue' => ' ',
        ],
        'registryId' => [
            'format' => FieldN::class,
            'position' => 159,
            'length' => 6,
            'rules' => [
                'required',
            ],
        ],
    ];
}
