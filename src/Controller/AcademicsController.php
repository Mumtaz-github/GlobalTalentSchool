<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AcademicsController extends AbstractController
{
    #[Route('/academics', name: 'academics')]
    public function index(CourseRepository $courseRepo): Response
    {
        $courses = $courseRepo->findAllOrdered();

        return $this->render('academics/index.html.twig', [
            'courses' => $courses,
        ]);
    }
}
