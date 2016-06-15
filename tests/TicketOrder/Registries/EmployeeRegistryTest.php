<?php

namespace Convenia\TicketOrder\Tests\Registries;

use Convenia\TicketOrder\Registries\EmployeeRegistry;
use Convenia\TicketOrder\Tests\BaseTest;

/**
 * Class EmployeeRegistryTest.
 */
class EmployeeRegistryTest extends BaseTest
{
    public function test_complete_fields_cpf()
    {
        $employee = new EmployeeRegistry(
            [
                'product' => 'R',
                'product2' => 'R',
                'registryId' => 3,
                'department' => 'ADM',
                'cpf'        => '207.792.083-15',
                'birthDate'  => '07061962',
                'branchName' => 'MATRIZ',
                'monthValue' => 23000,
                'name'       => 'GESIEL DE SOUSA RIBEIRO',
            ]
        );

        $expected = 'TR023ADM                       02077920831507061962                  MATRIZ                    00101000023000REGESIEL DE SOUSA RIBEIRO                        000003';

        $this->assertEquals($expected, $employee->__toString());
    }

    public function test_complete_fields()
    {
        $header = new EmployeeRegistry(
            [
                'product' => 'R',
                'product2' => 'R',
                'registryId' => 3,
                'department' => 'ADM',
                'cpf'        => '020779208315',
                'birthDate'  => '07061962',
                'branchName' => 'MATRIZ',
                'monthValue' => 23000,
                'name'       => 'GESIEL DE SOUSA RIBEIRO',
            ]
        );

        $expected = 'TR023ADM                       02077920831507061962                  MATRIZ                    00101000023000REGESIEL DE SOUSA RIBEIRO                        000003';

        $this->assertEquals($expected, (string)$header);
    }
}
