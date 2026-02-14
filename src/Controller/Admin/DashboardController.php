<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\InquiryRepository;
use App\Repository\CourseRepository;
use App\Repository\FacultyRepository;
use App\Repository\NewsRepository;
use App\Repository\GalleryImageRepository;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin', name: 'admin_', requirements: ['_locale' => 'en|ur|ps'])]
 #[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function index(
        InquiryRepository $inquiryRepo,
        CourseRepository $courseRepo,
        NewsRepository $newsRepo,
        FacultyRepository $facultyRepo,
        GalleryImageRepository $galleryRepo,
        SchoolRepository $schoolRepo
    ): Response {
        // Statistics
        $totalInquiries = count($inquiryRepo->findAll());
        $totalCourses = count($courseRepo->findAll());
        $totalNews = count($newsRepo->findAll());
        $totalFaculty = count($facultyRepo->findAll());
        $totalGalleryImages = count($galleryRepo->findAll());
        
        // Recent data
        $recentInquiries = $inquiryRepo->findBy([], ['createdAt' => 'DESC'], 5);
        $latestNews = $newsRepo->findLatest(5);
        
        // School info
        $school = $schoolRepo->findOneBy([]);

        return $this->render('admin/dashboard.html.twig', [
            'totalInquiries' => $totalInquiries,
            'totalCourses' => $totalCourses,
            'totalNews' => $totalNews,
            'totalFaculty' => $totalFaculty,
            'totalGalleryImages' => $totalGalleryImages,
            'recentInquiries' => $recentInquiries,
            'latestNews' => $latestNews,
            'school' => $school,
        ]);
    }
}