<?php

namespace Convenia\TicketOrder\Registries;

use Convenia\TicketOrder\Fields\Formats\FieldN;

/**
 * Class BranchRegistry.
 */
class BranchRegistry extends Registry
{
    /**
     * @var array
     */
    protected $defaultFields = [
        'registryType' => [
            'format' => FieldN::class,
            'position' => 1,
            'length' => 1,
            'defaultValue' => 1,
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
