<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CourseRepository;
use App\Repository\NewsRepository;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        SchoolRepository $schoolRepo,
        NewsRepository $newsRepo,
        CourseRepository $courseRepo
    ): Response {
        $school = $schoolRepo->findOneBy([]);
        $latestNews = $newsRepo->findLatest(3);
        $courses = $courseRepo->findAllOrdered();

        return $this->render('home/index.html.twig', [
            'school' => $school,
            'latestNews' => $latestNews,
            'courses' => $courses,
        ]);
    }
}