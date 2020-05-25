<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ResumeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @var ResumeServiceInterface
     */
    private ResumeServiceInterface $resumeService;

    /**
     * HomeController constructor.
     * @param ResumeServiceInterface $resumeService
     */
    public function __construct(ResumeServiceInterface $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $resume = $this->getResumeService()->getResume();

        return $this->render('home/index.twig', [
            'resume' => $resume,
        ]);
    }

    /**
     * @return ResumeServiceInterface
     */
    public function getResumeService(): ResumeServiceInterface
    {
        return $this->resumeService;
    }
}
