<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news_list')]
    public function list(NewsRepository $newsRepo): Response
    {
        $news = $newsRepo->findBy([], ['date' => 'DESC']);

        return $this->render('news/list.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/news/{id}', name: 'news_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id, NewsRepository $newsRepo): Response
    {
        $newsItem = $newsRepo->find($id);

        if (!$newsItem) {
            throw $this->createNotFoundException('News article not found');
        }

        return $this->render('news/detail.html.twig', [
            'newsItem' => $newsItem,
        ]);
    }
}
