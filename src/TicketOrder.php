<?php

namespace Convenia\TicketOrder;

use Convenia\TicketOrder\Exceptions\InvalidProductTypeException;
use Convenia\TicketOrder\Exceptions\ProductTypeIsRequiredException;
use Convenia\TicketOrder\Interfaces\TicketOrderInterface;
use Convenia\TicketOrder\Registries\HeaderRegistry;
use Stringy\Stringy;

/**
 * Class AleloOrder.
 */
class TicketOrder implements TicketOrderInterface
{
    /**
     * @var Stringy
     */
    protected $fileLayout;

    /**
     * @var HeaderRegistry
     */
    public $header;

    /**
     * @var BranchRegistry
     */
    protected $branch;

    /**
     * Array of EmployeeRegisty
     *
     * @var array
     */
    protected $employees = [];

    /**
     * @var TraillerRegistry
     */
    protected $traillerRegistry;

    /**
     * Product type
     *
     * TR01 - Paper
     * A - Eletronic card - Alimentação
     * R - Eletronic card - Refeição
     * @var string
     */
    protected $productType = null;

    protected $validProductTypes = [
        'TR01',
        'A',
        'R'
    ];

    /**
     * AleloOrder constructor.
     * @param array $headerData
     */
    public function __construct(array $headerData)
    {
        $this->header = new HeaderRegistry($headerData);
        $this->fileLayout = Stringy::create('');
    }

    /**
     * @return $this
     */
    public function typeRefeicao()
    {
        $this->setProductType('R');

        return $this;
    }

    /**
     * @return $this
     */
    public function typeAlimentacao()
    {
        $this->setProductType('A');

        return $this;
    }

    /**
     * @return $this
     */
    public function typeRefeicaoPapel()
    {
        $this->setProductType('TR01');

        return $this;
    }

    /**
     * @param $productType
     * @return bool
     * @throws InvalidProductTypeException
     */
    public function setProductType($productType)
    {
        if(in_array($productType, $this->validProductTypes)) {
            $this->productType = $productType;
            return true;
        }

        throw new InvalidProductTypeException(
            '\''.$productType. '\' is invalid, valid products are '. implode(', ', $this->validProductTypes)
        );
    }

    /**
     * @param array $employeeData
     */
    public function addEmployee(array $employeeData)
    {
        $registryId = 2+count($this->getAllEmployees())+1;
        $employeeData = array_merge(['registryId' => $registryId], $employeeData);

        $this->employees[] = new EmployeeRegistry($employeeData);
    }

    /**
     * @return array
     */
    public function getAllEmployees()
    {
        return $this->employees;
    }

    /**
     * @return int
     */
    public function employeesCount()
    {
        return count($this->getAllEmployees());
    }

    /**
     * Generate the alelo orders file.
     *
     * @return string
     */
    public function generate()
    {
        if ($this->productType === null) {
            throw new ProductTypeIsRequiredException();
        }

        $this->generateTraillerRegistry();
        $this->fileLayout = $this->fileLayout->append($this->header->__toString());
        $this->fileLayout = $this->fileLayout->append(PHP_EOL);
        $this->fileLayout = $this->fileLayout->append($this->branch->__toString());
        $this->fileLayout = $this->fileLayout->append(PHP_EOL);

        foreach ($this->getAllEmployees() as $employeeRegistry) {
            $this->fileLayout = $this->fileLayout->append($employeeRegistry->__toString());
            $this->fileLayout = $this->fileLayout->append(PHP_EOL);
        }

        $this->fileLayout = $this->fileLayout->append($this->traillerRegistry->__toString());

        return (string) $this->fileLayout;
    }

    /**
     * Generate the Trailler Registry.
     */
    protected function generateTraillerRegistry()
    {
        $this->traillerRegistry = new TraillerRegistry(
            [
                'employeeRegTotals' => $this->employeesCount(),
                'orderTotal' => $this->orderTotal(),
                'registryId' => count($this->getAllEmployees())+3,
            ]
        );
        return $this->traillerRegistry;
    }

    /**
     * @return int
     */
    protected function orderTotal()
    {
        $orderTotal = 0;

        /** @var EmployeeRegistry $employee */
        foreach ($this->getAllEmployees() as $employee) {
            $orderTotal += $employee->getField('monthValue')->getValue();
        }

        return $orderTotal;
    }
}
