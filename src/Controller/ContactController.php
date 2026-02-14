<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Inquiry;
use App\Form\InquiryType;
use App\Repository\SchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact', requirements: ['_locale' => 'en|ur|ps'])]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        MailerInterface $mailer,
        SchoolRepository $schoolRepo
    ): Response {
        $inquiry = new Inquiry();
        $inquiry->setType('contact');
        
        $form = $this->createForm(InquiryType::class, $inquiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($inquiry);
            $em->flush();

            $school = $schoolRepo->findOneBy([]);
            if ($school && $school->getEmail()) {
                try {
                    $email = (new Email())
                        ->from($inquiry->getEmail())
                        ->to($school->getEmail())
                        ->subject('New Contact Inquiry - ' . $inquiry->getName())
                        ->text(sprintf(
                            "Name: %s\nEmail: %s\nPhone: %s\nType: %s\n\nMessage:\n%s",
                            $inquiry->getName(),
                            $inquiry->getEmail(),
                            $inquiry->getPhone() ?? 'N/A',
                            $inquiry->getType(),
                            $inquiry->getMessage()
                        ));

                    $mailer->send($email);
                } catch (\Exception $e) {
                    // Log error but don't break the flow
                }
            }

            $this->addFlash('success', 'Thank you! Your message has been sent successfully. We will contact you soon.');
            return $this->redirectToRoute('contact');
        }

        $school = $schoolRepo->findOneBy([]);

        return $this->render('contact/index.html.twig', [
            'form' => $form,
            'school' => $school,
        ]);
    }
}