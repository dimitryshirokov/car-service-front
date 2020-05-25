<?php

declare(strict_types=1);

namespace App\Controller;

use DataTables\DataTablesInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AjaxController
 * @package App\Controller
 */
class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax/employers", name="ajax_employers")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getEmployers(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        $result = $dataTables->handle($request, 'employers');

        return $this->json($result);
    }

    /**
     * @Route("/ajax/works", name="ajax_works")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getWorks(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        $result = $dataTables->handle($request, 'works');

        return $this->json($result);
    }

    /**
     * @Route("/ajax/new_orders", name="ajax_new_orders")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getNewOrders(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        return $this->getOrders($request, $dataTables, 'new_orders');
    }

    /**
     * @Route("/ajax/in_progress_orders", name="ajax_in_progress_orders")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getInProgressOrders(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        return $this->getOrders($request, $dataTables, 'in_progress_orders');
    }

    /**
     * @Route("/ajax/cancelled_orders", name="ajax_cancelled_orders")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getCancelledOrders(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        return $this->getOrders($request, $dataTables, 'cancelled_orders');
    }

    /**
     * @Route("/ajax/done_orders", name="ajax_done_orders")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getDoneOrders(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        return $this->getOrders($request, $dataTables, 'done_orders');
    }

    /**
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @param string $id
     * @return JsonResponse
     */
    private function getOrders(Request $request, DataTablesInterface $dataTables, string $id): JsonResponse
    {
        $result = $dataTables->handle($request, $id);

        return $this->json($result);
    }

    /**
     * @Route("/ajax/customers", name="ajax_customers")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getCustomers(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        $result = $dataTables->handle($request, 'customers');

        return $this->json($result);
    }

    /**
     * @Route("/ajax/cars", name="ajax_cars")
     * @param Request $request
     * @param DataTablesInterface $dataTables
     * @return JsonResponse
     */
    public function getCars(Request $request, DataTablesInterface $dataTables): JsonResponse
    {
        $result = $dataTables->handle($request, 'cars');

        return $this->json($result);
    }
}
