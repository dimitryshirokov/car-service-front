<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CustomerForm;
use App\Form\FindCustomerForm;
use App\Model\Form\Customer;
use App\Model\Form\FindCustomer;
use App\Service\CustomerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomerController
 * @package App\Controller
 */
class CustomerController extends AbstractController
{
    /**
     * @var CustomerServiceInterface
     */
    private CustomerServiceInterface $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerServiceInterface $customerService
     */
    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @Route("/customer/create", name="create_customer")
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function create(Request $request)
    {
        $model = new Customer();
        $form = $this->createForm(CustomerForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customerId = $this->getCustomerService()->create($form->getData());
            return $this->redirectToRoute('show_customer', ['customerId' => $customerId]);
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('customer/create.twig', [
            'title' => 'Добавить клиента',
            'form' => $formView
        ]);
    }

    /**
     * @Route("/customer/show/{customerId}", name="show_customer")
     * @param int $customerId
     * @return Response
     */
    public function show(int $customerId): Response
    {
        $customer = $this->getCustomerService()->get($customerId);

        return $this->render('customer/show.twig', [
            'customerId' => $customerId,
            'customer' => $customer,
        ]);
    }

    /**
     * @Route("/customer/edit/{customerId}", name="edit_customer")
     * @param int $customerId
     * @param Request $request
     * @return Response
     */
    public function edit(int $customerId, Request $request): Response
    {
        $model = $this->getCustomerService()->getFormModel($customerId);
        $form = $this->createForm(CustomerForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customerId = $this->getCustomerService()->update($form->getData());
            return $this->redirectToRoute('show_customer', ['customerId' => $customerId]);
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('customer/create.twig', [
            'title' => 'Изменить клиента',
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/customer/find", name="find_customer")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function find(Request $request)
    {
        $errorMessage = null;
        $model = new FindCustomer();
        $form = $this->createForm(FindCustomerForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var FindCustomer $model */
            $model = $form->getData();
            $customerId = $this->getCustomerService()->find($model);
            if ($customerId !== null) {
                return $this->redirectToRoute('show_customer', ['customerId' => $customerId]);
            }
            $errorMessage = sprintf(
                'Не найден клиент с телефоном %s',
                $model->getPhone()
            );
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('customer/find.twig', [
            'errorMessage' => $errorMessage,
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/customer/list", name="list_customers")
     * @return Response
     */
    public function customerList(): Response
    {
        return $this->render('customer/list.twig');
    }

    /**
     * @return CustomerServiceInterface
     */
    public function getCustomerService(): CustomerServiceInterface
    {
        return $this->customerService;
    }
}
