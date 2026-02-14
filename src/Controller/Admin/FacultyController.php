<?php

namespace App\Controller\Admin;

use App\Entity\Faculty;
use App\Form\FacultyType;
use App\Repository\FacultyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/faculty')]
final class FacultyController extends AbstractController
{
    #[Route(name: 'app_faculty_index', methods: ['GET'])]
    public function index(FacultyRepository $facultyRepository): Response
    {
        return $this->render('admin/faculty/index.html.twig', [
            'faculties' => $facultyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_faculty_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $faculty = new Faculty();
        $form = $this->createForm(FacultyType::class, $faculty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($faculty);
            $entityManager->flush();

            return $this->redirectToRoute('app_faculty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/faculty/new.html.twig', [
            'faculty' => $faculty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_faculty_show', methods: ['GET'])]
    public function show(Faculty $faculty): Response
    {
        return $this->render('admin/faculty/show.html.twig', [
            'faculty' => $faculty,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_faculty_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Faculty $faculty, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FacultyType::class, $faculty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_faculty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/faculty/edit.html.twig', [
            'faculty' => $faculty,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_faculty_delete', methods: ['POST'])]
    public function delete(Request $request, Faculty $faculty, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$faculty->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($faculty);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_faculty_index', [], Response::HTTP_SEE_OTHER);
    }
}
