<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function index(SchoolRepository $schoolRepo): Response
    {
        $school = $schoolRepo->findOneBy([]);

        return $this->render('about/index.html.twig', [
            'school' => $school,
        ]);
    }
}