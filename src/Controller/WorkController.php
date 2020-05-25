<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\WorkForm;
use App\Model\Work;
use App\Service\WorkServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class WorkController
 * @package App\Controller
 */
class WorkController extends AbstractController
{
    /**
     * @var WorkServiceInterface
     */
    private WorkServiceInterface $workService;

    /**
     * WorkController constructor.
     * @param WorkServiceInterface $workService
     */
    public function __construct(WorkServiceInterface $workService)
    {
        $this->workService = $workService;
    }

    /**
     * @Route("/work/create/", name="create_work")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $workId = null;
        $model = new Work();
        $form = $this->createForm(WorkForm::class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $workId = $this->getWorkService()->create($form->getData());
        }

        $formView = $this->renderView('form.twig', ['form' => $form->createView()]);

        return $this->render('work/create.twig', [
            'form' => $formView,
            'workId' => $workId,
        ]);
    }

    /**
     * @Route("/work/list", name="work_list")
     * @return Response
     */
    public function worksList(): Response
    {
        return $this->render('work/list.twig');
    }

    /**
     * @return WorkServiceInterface
     */
    public function getWorkService(): WorkServiceInterface
    {
        return $this->workService;
    }
}
