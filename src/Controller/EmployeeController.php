<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\EmployeeForm;
use App\Model\Employee;
use App\Service\EmployeeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EmployeeController
 * @package App\Controller
 */
class EmployeeController extends AbstractController
{
    /**
     * @var EmployeeServiceInterface
     */
    private EmployeeServiceInterface $employeeService;

    /**
     * EmployeeController constructor.
     * @param EmployeeServiceInterface $employeeService
     */
    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @Route("/employee/create", name="create_employee")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $employeeId = null;
        $model = new Employee();
        $form = $this->createForm(EmployeeForm::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employeeId = $this->getEmployeeService()->createEmployee($form->getData());
            if ($employeeId !== null) {
                return $this->redirectToRoute('show_employee', ['employeeId' => $employeeId]);
            }
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('employee/create.twig', [
            'employeeId' => $employeeId,
            'form' => $formView,
            'title' => 'Создание работника',
        ]);
    }

    /**
     * @Route("/employee/list", name="employee_list")
     * @return Response
     */
    public function employeeList(): Response
    {
        return $this->render('employee/list.twig');
    }

    /**
     * @Route("/employee/show/{employeeId}", name="show_employee")
     * @param int $employeeId
     * @return Response
     */
    public function show(int $employeeId): Response
    {
        $employee = $this->getEmployeeService()->show($employeeId);

        return $this->render('employee/show.twig', [
            'employerId' => $employeeId,
            'employer' => $employee,
        ]);
    }

    /**
     * @Route("/employee/update/{employeeId}", name="update_employee")
     * @param int $employeeId
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function update(int $employeeId, Request $request)
    {
        $model = $this->getEmployeeService()->createUpdateData($employeeId);
        $form = $this->createForm(EmployeeForm::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employeeId = $this->getEmployeeService()->update($form->getData());
            if ($employeeId !== null) {
                return $this->redirectToRoute('show_employee', ['employeeId' => $employeeId]);
            }
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('employee/create.twig', [
            'employeeId' => $employeeId,
            'form' => $formView,
            'title' => 'Обновление работника',
        ]);
    }

    /**
     * @Route("/employee/delete/{employeeId}", name="delete_employee")
     * @param int $employeeId
     * @return RedirectResponse
     */
    public function delete(int $employeeId): RedirectResponse
    {
        $this->getEmployeeService()->delete($employeeId);

        return $this->redirectToRoute('employee_list');
    }

    /**
     * @return EmployeeServiceInterface
     */
    public function getEmployeeService(): EmployeeServiceInterface
    {
        return $this->employeeService;
    }
}
