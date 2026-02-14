<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FacultyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FacultyController extends AbstractController
{
    #[Route('/faculty', name: 'faculty')]
    public function index(FacultyRepository $facultyRepo): Response
    {
        $faculty = $facultyRepo->findAllOrdered();

        return $this->render('faculty/index.html.twig', [
            'faculty' => $faculty,
        ]);
    }
}
