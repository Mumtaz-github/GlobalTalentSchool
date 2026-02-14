<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\GalleryImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'gallery')]
    public function index(Request $request, GalleryImageRepository $galleryRepo): Response
    {
        $category = $request->query->get('category');
        $images = $galleryRepo->findByCategory($category);

        return $this->render('gallery/index.html.twig', [
            'images' => $images,
            'currentCategory' => $category,
        ]);
    }
}