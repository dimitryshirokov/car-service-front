<?php

declare(strict_types=1);

namespace App\Service;

use App\Client\CarServiceClient;
use App\Extractor\ExtractorInterface;
use App\Hydrator\HydratorInterface;
use App\Model\CustomerShow\Customer as CustomerShow;
use App\Model\Form\Customer;
use App\Model\Form\FindCustomer;

/**
 * Class CustomerService
 * @package App\Service
 */
class CustomerService implements CustomerServiceInterface
{
    /**
     * @var CarServiceClient
     */
    private CarServiceClient $client;

    /**
     * @var ExtractorInterface
     */
    private ExtractorInterface $extractor;

    /**
     * @var HydratorInterface
     */
    private HydratorInterface $hydrator;

    /**
     * CustomerService constructor.
     * @param CarServiceClient $client
     * @param ExtractorInterface $extractor
     * @param HydratorInterface $hydrator
     */
    public function __construct(CarServiceClient $client, ExtractorInterface $extractor, HydratorInterface $hydrator)
    {
        $this->client = $client;
        $this->extractor = $extractor;
        $this->hydrator = $hydrator;
    }

    /**
     * @param Customer $customer
     * @return int
     */
    public function create(Customer $customer): int
    {
        $customer = $this->getExtractor()->extract($customer);

        return $this->getClient()->createCustomer($customer);
    }

    /**
     * @param int $customerId
     * @return CustomerShow
     */
    public function get(int $customerId): CustomerShow
    {
        $customerShow = new CustomerShow();
        $customer = $this->getClient()->getCustomer($customerId);
        $this->getHydrator()->hydrate($customer, $customerShow);

        return $customerShow;
    }

    /**
     * @param int $customerId
     * @return Customer
     */
    public function getFormModel(int $customerId): Customer
    {
        $customerShow = $this->get($customerId);
        $customer = new Customer();
        $customer->setId($customerShow->getId())
            ->setSurname($customerShow->getSurname())
            ->setName($customerShow->getName())
            ->setPatronymic($customerShow->getPatronymic())
            ->setPhone($customerShow->getPhone())
            ->setDiscount($customerShow->getDiscount());

        return $customer;
    }

    /**
     * @param Customer $customer
     * @return int
     */
    public function update(Customer $customer): int
    {
        $customer = $this->getExtractor()->extract($customer);

        return $this->getClient()->updateCustomer($customer);
    }

    /**
     * @param FindCustomer $findCustomer
     * @return int|null
     */
    public function find(FindCustomer $findCustomer): ?int
    {
        return $this->getClient()->findCustomer($findCustomer->getPhone());
    }

    /**
     * @return CarServiceClient
     */
    public function getClient(): CarServiceClient
    {
        return $this->client;
    }

    /**
     * @return ExtractorInterface
     */
    public function getExtractor(): ExtractorInterface
    {
        return $this->extractor;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator(): HydratorInterface
    {
        return $this->hydrator;
    }
}
