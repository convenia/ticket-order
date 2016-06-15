<?php

namespace Convenia\TicketOrder;

use Carbon\Carbon;
use Convenia\TicketOrder\Exceptions\AreaCodeRequiredException;
use Convenia\TicketOrder\Exceptions\InvalidProductTypeException;
use Convenia\TicketOrder\Exceptions\ProductTypeIsRequiredException;
use Convenia\TicketOrder\Interfaces\TicketOrderInterface;
use Convenia\TicketOrder\Registries\BranchRegistry;
use Convenia\TicketOrder\Registries\EmployeeRegistry;
use Convenia\TicketOrder\Registries\HeaderEletronicRegistry;
use Convenia\TicketOrder\Registries\HeaderRegistry;
use Convenia\TicketOrder\Registries\TraillerRegistry;
use Stringy\Stringy;

/**
 * Class AleloOrder.
 */
class TicketOrder implements TicketOrderInterface
{
    /**
     * @var string
     */
    protected $orderUser = 'TicketOrder';

    /**
     * @var Stringy
     */
    protected $fileLayout;

    /**
     * @var HeaderRegistry
     */
    public $header;

    /**
     * @var HeaderEletronicRegistry
     */
    public $headerEletronic;

    /**
     * @var BranchRegistry
     */
    protected $branch;

    /**
     * Array of EmployeeRegisty.
     *
     * @var array
     */
    protected $employees = [];

    /**
     * @var TraillerRegistry
     */
    protected $traillerRegistry;

    /**
     * Product type.
     *
     * TAE - Eletronic card - Alimentação
     * TRE - Eletronic card - Refeição
     *
     * @var string
     */
    protected $productType = null;

    /**
     * @var array
     */
    protected $validProductTypes = [
        'TAE' => 'A',
        'TRE' => 'R',
    ];

    protected $cardTypes = [
        'TAE' => '33',
        'TRE' => '34',
    ];

    /**
     * TicketOrder constructor.
     */
    public function __construct()
    {
        $this->fileLayout = Stringy::create('');
    }

    /**
     * Setup the order.
     *
     * @param array $orderData
     *
     * @return $this
     */
    public function orderSetup(array $orderData)
    {
        $defaultValues = [
            'product'    => $this->productType,
            'product2'   => $this->productType,
            'cardType'   => $this->cardTypes[$this->productType],
            'registryId' => 1,
        ];

        $defaultValues = array_merge($defaultValues, $orderData);

        $this->headerEletronic = new HeaderEletronicRegistry($defaultValues);

        return $this;
    }

    /**
     * @param array $deliveryData
     *
     * @throws AreaCodeRequiredException
     *
     * @return $this
     */
    public function deliverySetup(array $deliveryData)
    {
        if (!isset($deliveryData['areaCode'])) {
            throw new AreaCodeRequiredException();
        }

        $deliveryData['areaCode'] = str_replace('-', '', $deliveryData['areaCode']);

        $areaCodeBase = substr($deliveryData['areaCode'], 0, 5);
        $areaCode = substr($deliveryData['areaCode'], 5, 3);

        $defaulValues = [
            'product'      => $this->productType,
            'areaCodeBase' => $areaCodeBase,
            'areaCode'     => $areaCode,
            'registryId'   => 2,
        ];

        $deliveryData = array_merge($deliveryData, $defaulValues);

        $this->branch = new BranchRegistry($deliveryData);

        return $this;
    }

    /**
     * @return $this
     */
    public function typeRefeicao()
    {
        $this->setProductType('TRE');

        return $this;
    }

    /**
     * @return $this
     */
    public function typeAlimentacao()
    {
        $this->setProductType('TAE');

        return $this;
    }

    /**
     * @param $productType
     *
     * @throws InvalidProductTypeException
     *
     * @return $this
     */
    public function setProductType($productType)
    {
        if (in_array($productType, array_keys($this->validProductTypes))) {
            $this->productType = $productType;

            return $this;
        }

        throw new InvalidProductTypeException(
            '\''.$productType.'\' is invalid, valid products are '.implode(', ', $this->validProductTypes)
        );
    }

    /**
     * @param array $employeeData
     *
     * @return $this
     */
    public function addEmployee(array $employeeData)
    {
        $registryId = 2 + count($this->getAllEmployees()) + 1;

        $defaultValue = [
            'product'    => $this->productType,
            'product2'   => $this->productType,
            'registryId' => $registryId,
        ];

        $employeeData = array_merge($defaultValue, $employeeData);

        $this->employees[] = new EmployeeRegistry($employeeData);

        return $this;
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

        $this->header = new HeaderRegistry([
            'requesterUser' => $this->orderUser,
            'orderDate'     => (new Carbon())->format('Ymd'),
            'orderTime'     => (new Carbon())->format('H.i.s'),
        ]);

        $this->generateTraillerRegistry();

        $this->fileLayout = $this->fileLayout->append($this->header->__toString());
        $this->fileLayout = $this->fileLayout->append(PHP_EOL);
        $this->fileLayout = $this->fileLayout->append($this->headerEletronic->__toString());
        $this->fileLayout = $this->fileLayout->append(PHP_EOL);
        $this->fileLayout = $this->fileLayout->append($this->branch->__toString());
        $this->fileLayout = $this->fileLayout->append(PHP_EOL);

        foreach ($this->getAllEmployees() as $employeeRegistry) {
            $this->fileLayout = $this->fileLayout->append($employeeRegistry->__toString());
            $this->fileLayout = $this->fileLayout->append(PHP_EOL);
        }

        $this->fileLayout = $this->fileLayout->append($this->traillerRegistry->__toString());

        return $this->fileLayout->__toString();
    }

    /**
     * Generate the Trailler Registry.
     */
    protected function generateTraillerRegistry()
    {
        $this->traillerRegistry = new TraillerRegistry(
            [
                'product'           => $this->productType,
                'employeeRegTotals' => $this->employeesCount(),
                'orderTotal'        => $this->orderTotal(),
                'registryId'        => count($this->getAllEmployees()) + 3,
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
