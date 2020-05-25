<?php

declare(strict_types=1);

namespace App\Controller;

use App\Client\Exception\ValidationException;
use App\Form\FindOrderForm;
use App\Model\Form\FindOrder;
use App\Model\OrderShow\Order;
use App\Processor\DataProcessorInterface;
use App\Service\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OrderController
 * @package App\Controller
 */
class OrderController extends AbstractController
{
    /**
     * @var OrderServiceInterface
     */
    private OrderServiceInterface $orderService;

    /**
     * @var DataProcessorInterface
     */
    private DataProcessorInterface $dataProcessor;

    /**
     * OrderController constructor.
     * @param OrderServiceInterface $orderService
     * @param DataProcessorInterface $dataProcessor
     */
    public function __construct(OrderServiceInterface $orderService, DataProcessorInterface $dataProcessor)
    {
        $this->orderService = $orderService;
        $this->dataProcessor = $dataProcessor;
    }

    /**
     * @Route("/order/create", name="create_order")
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function create(Request $request)
    {
        $data = $this->getOrderService()->getCreateData();
        $errorMessage = null;

        if ($request->isMethod('POST')) {
            $params = $request->request->all();
            $params = $this->getDataProcessor()->processData($params);
            try {
                $orderId = $this->getOrderService()->createOrder($params);
            } catch (ValidationException $notFoundException) {
                $errorMessage = $notFoundException->getMessage();
            }
            if ($errorMessage === null) {
                return $this->redirectToRoute('show_order', ['orderId' => $orderId]);
            }
        }

        return $this->render('order/create.twig', [
            'errorMessage' => $errorMessage,
            'works' => json_encode($data['works']),
            'employers' => json_encode($data['employers']),
        ]);
    }

    /**
     * @Route("/order/show/{orderId}", name="show_order")
     * @param int $orderId
     * @return Response
     */
    public function showOrder(int $orderId): Response
    {
        $order = $this->getOrderService()->getOrder($orderId);
        return $this->render('order/show.twig', [
            'orderId' => $orderId,
            'order' => $order,
        ]);
    }

    /**
     * @Route("/order/in-progress/{orderId}", name="chage_order_to_in_progress")
     * @param int $orderId
     * @return RedirectResponse
     */
    public function changeOrderToInProgress(int $orderId): RedirectResponse
    {
        return $this->changeOrderStatus($orderId, Order::STATUS_IN_PROGRESS);
    }

    /**
     * @Route("/order/done/{orderId}", name="change_order_to_done")
     * @param int $orderId
     * @return RedirectResponse
     */
    public function changeOrderToDone(int $orderId): RedirectResponse
    {
        return $this->changeOrderStatus($orderId, Order::STATUS_DONE);
    }

    /**
     * @Route("/order/cancel/{orderId}", name="cancel_order")
     * @param int $orderId
     * @return RedirectResponse
     */
    public function cancelOrder(int $orderId): RedirectResponse
    {
        return $this->changeOrderStatus($orderId, Order::STATUS_CANCELLED);
    }

    /**
     * @param int $orderId
     * @param string $status
     * @return RedirectResponse
     */
    private function changeOrderStatus(int $orderId, string $status): RedirectResponse
    {
        $orderId = $this->getOrderService()->changeStatus($orderId, $status);

        return $this->redirectToRoute('show_order', ['orderId' => $orderId]);
    }

    /**
     * @Route("/order/find/", name="find_order")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function find(Request $request)
    {
        $errorMessage = null;
        $model = new FindOrder();
        $form = $this->createForm(FindOrderForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var FindOrder $model */
            $model = $form->getData();
            $orderId = $this->getOrderService()->find($model->getId());
            if ($orderId !== null) {
                return $this->redirectToRoute('show_order', ['orderId' => $orderId]);
            }
            $errorMessage = sprintf(
                'Не найден заказ с номером %s',
                $model->getId()
            );
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('order/find.twig', [
            'errorMessage' => $errorMessage,
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/order/list/new", name="new_order_list")
     * @return Response
     */
    public function newOrdersList(): Response
    {
        return $this->ordersList('Новые заказы', $this->generateUrl('ajax_new_orders'));
    }

    /**
     * @Route("/order/list/in_progress", name="in_progress_order_list")
     * @return Response
     */
    public function inProgressOrdersList(): Response
    {
        return $this->ordersList('Заказы в работе', $this->generateUrl('ajax_in_progress_orders'));
    }

    /**
     * @Route("/order/list/cancelled", name="cancelled_order_list")
     * @return Response
     */
    public function cancelledOrdersList(): Response
    {
        return $this->ordersList('Отменённые заказы', $this->generateUrl('ajax_cancelled_orders'));
    }

    /**
     * @Route("/order/list/done", name="done_order_list")
     * @return Response
     */
    public function doneOrdersList(): Response
    {
        return $this->ordersList('Выполненные заказы', $this->generateUrl('ajax_done_orders'));
    }

    /**
     * @param string $title
     * @param string $url
     * @return Response
     */
    private function ordersList(string $title, string $url): Response
    {
        return $this->render('order/list.twig', [
            'title' => $title,
            'dataTablesUrl' => $url,
        ]);
    }

    /**
     * @return OrderServiceInterface
     */
    public function getOrderService(): OrderServiceInterface
    {
        return $this->orderService;
    }

    /**
     * @return DataProcessorInterface
     */
    public function getDataProcessor(): DataProcessorInterface
    {
        return $this->dataProcessor;
    }
}
