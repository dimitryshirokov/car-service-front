<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Form\Customer;
use App\Model\CustomerShow\Customer as CustomerShow;
use App\Model\Form\FindCustomer;

/**
 * Interface CustomerServiceInterface
 * @package App\Service
 */
interface CustomerServiceInterface
{
    /**
     * @param Customer $customer
     * @return int
     */
    public function create(Customer $customer): int;

    /**
     * @param int $customerId
     * @return CustomerShow
     */
    public function get(int $customerId): CustomerShow;

    /**
     * @param int $customerId
     * @return Customer
     */
    public function getFormModel(int $customerId): Customer;

    /**
     * @param Customer $customer
     * @return int
     */
    public function update(Customer $customer): int;

    /**
     * @param FindCustomer $findCustomer
     * @return int|null
     */
    public function find(FindCustomer $findCustomer): ?int;
}
