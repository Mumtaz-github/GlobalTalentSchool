<?php


declare(strict_types=1);

namespace App\Controller;

use App\Form\AdmissionApplicationType;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdmissionsController extends AbstractController
{
    #[Route('/admissions', name: 'admissions')]
    public function index(
        Request $request,
        SchoolRepository $schoolRepo
    ): Response {
        $form = $this->createForm(AdmissionApplicationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $school = $schoolRepo->findOneBy([]);
            
            // Build WhatsApp message
            $message = "🎓 *NEW ADMISSION APPLICATION*\n\n";
            $message .= "📚 *Student Information:*\n";
            $message .= "Name: {$data['student_name']}\n";
            $message .= "Grade: " . str_replace('_', ' ', ucfirst($data['grade'])) . "\n\n";
            $message .= "👨‍👩‍👧 *Parent/Guardian:*\n";
            $message .= "Name: {$data['parent_name']}\n";
            $message .= "Email: {$data['email']}\n";
            $message .= "Phone: {$data['phone']}\n\n";
            
            if (!empty($data['previous_school'])) {
                $message .= "🏫 Previous School: {$data['previous_school']}\n\n";
            }
            
            if (!empty($data['comments'])) {
                $message .= "💬 Comments: {$data['comments']}\n";
            }
            
            // WhatsApp number (remove + and spaces)
            $whatsappNumber = $school ? preg_replace('/[^0-9]/', '', $school->getWhatsapp()) : '92XXXXXXXXX';
            $encodedMessage = urlencode($message);
            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";
            
            // Redirect to WhatsApp
            return $this->redirect($whatsappUrl);
        }

        $school = $schoolRepo->findOneBy([]);

        return $this->render('admissions/index.html.twig', [
            'form' => $form,
            'school' => $school,
        ]);
    }

    #[Route('/admissions/modal', name: 'admissions_modal')]
    public function modal(Request $request, SchoolRepository $schoolRepo): Response
    {
        $form = $this->createForm(AdmissionApplicationType::class);
        
        return $this->render('admissions/modal.html.twig', [
            'form' => $form,
        ]);
    }
}
// declare(strict_types=1);

// namespace App\Controller;

// use App\Entity\Inquiry;
// use App\Form\InquiryType;
// use App\Repository\SchoolRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Mailer\MailerInterface;
// use Symfony\Component\Mime\Email;
// use Symfony\Component\Routing\Attribute\Route;

// class AdmissionsController extends AbstractController
// {
//     #[Route('/admissions', name: 'admissions', requirements: ['_locale' => 'en|ur|ps'])]
//     public function index(
//         Request $request,
//         EntityManagerInterface $em,
//         MailerInterface $mailer,
//         SchoolRepository $schoolRepo
//     ): Response {
//         $inquiry = new Inquiry();
//         $inquiry->setType('admission');
        
//         $form = $this->createForm(InquiryType::class, $inquiry);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $em->persist($inquiry);
//             $em->flush();

//             // Send email notification
//             $school = $schoolRepo->findOneBy([]);
//             if ($school && $school->getEmail()) {
//                 try {
//                     $email = (new Email())
//                         ->from($inquiry->getEmail())
//                         ->to($school->getEmail())
//                         ->subject('New Admission Inquiry - ' . $inquiry->getName())
//                         ->text(sprintf(
//                             "Name: %s\nEmail: %s\nPhone: %s\nType: %s\n\nMessage:\n%s",
//                             $inquiry->getName(),
//                             $inquiry->getEmail(),
//                             $inquiry->getPhone() ?? 'N/A',
//                             $inquiry->getType(),
//                             $inquiry->getMessage()
//                         ));

//                     $mailer->send($email);
//                 } catch (\Exception $e) {
//                     // Log error
//                 }
//             }

//             $this->addFlash('success', 'Thank you! Your admission inquiry has been submitted successfully. We will contact you soon.');
//             return $this->redirectToRoute('admissions');
//         }

//         $school = $schoolRepo->findOneBy([]);

//         return $this->render('admissions/index.html.twig', [
//             'form' => $form,
//             'school' => $school,
//         ]);
//     }
// }