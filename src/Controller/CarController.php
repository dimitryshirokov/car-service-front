<?php

declare(strict_types=1);

namespace App\Controller;

use App\Client\Exception\ValidationException;
use App\Form\CarForm;
use App\Form\FindCarForm;
use App\Model\Form\Car;
use App\Model\Form\FindCar;
use App\Service\CarServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CarController
 * @package App\Controller
 */
class CarController extends AbstractController
{
    /**
     * @var CarServiceInterface
     */
    private CarServiceInterface $carService;

    /**
     * CarController constructor.
     * @param CarServiceInterface $carService
     */
    public function __construct(CarServiceInterface $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @Route("/car/create", name="create_car")
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function create(Request $request)
    {
        $errorMessage = null;
        $model = new Car();
        $form = $this->createForm(CarForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $carId = $this->getCarService()->create($form->getData());
                return $this->redirectToRoute('show_car', ['carId' => $carId]);
            } catch (ValidationException $notFoundException) {
                $errorMessage = $notFoundException->getMessage();
            }
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('car/create.twig', [
            'errorMessage' => $errorMessage,
            'title' => 'Добавить автомобиль',
            'form' => $formView,
        ]);
    }

    /**
     * @Route("/car/show/{carId}", name="show_car")
     * @param int $carId
     * @return Response
     */
    public function show(int $carId): Response
    {
        $car = $this->getCarService()->get($carId);

        return $this->render('car/show.twig', [
            'carId' => $carId,
            'car' => $car,
        ]);
    }

    /**
     * @Route("/car/list", name="list_cars")
     * @return Response
     */
    public function listCars(): Response
    {
        return $this->render('car/list.twig');
    }

    /**
     * @Route("/car/find", name="find_car")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function find(Request $request)
    {
        $errorMessage = null;
        $model = new FindCar();
        $form = $this->createForm(FindCarForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var FindCar $model */
            $model = $form->getData();
            $carId = $this->getCarService()->findCar($model->getVin());
            if ($carId !== null) {
                return $this->redirectToRoute('show_car', ['carId' => $carId]);
            }
            $errorMessage = 'Не найден автомобиль с VIN кодом ' . $model->getVin();
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('car/find.twig', [
            'errorMessage' => $errorMessage,
            'form' => $formView,
        ]);
    }

    /**
     * @return CarServiceInterface
     */
    public function getCarService(): CarServiceInterface
    {
        return $this->carService;
    }
}
