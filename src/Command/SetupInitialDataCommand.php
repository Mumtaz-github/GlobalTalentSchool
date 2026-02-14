<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Course;
use App\Entity\News;
use App\Entity\School;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:setup-initial-data',
    description: 'Setup initial data for Global Talent School',
)]
class SetupInitialDataCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Create School
        $school = new School();
        $school->setName('Global Talent School');
        $school->setAddress('Bara Bandai, Swat, Pakistan');
        $school->setPhone('+92 343 2306323');
        $school->setEmail('gtsswat@gmail.com');
        $school->setWhatsapp('+92 343 2306323');
        $school->setAboutText('Global Talent School, located in the beautiful valley of Bara Bandai, Swat, is dedicated to providing world-class education that combines academic excellence with character development. Our innovative approach to learning ensures that every child receives individual attention and opportunities to excel.');
        $school->setMission('To nurture global talent through innovative, activity-based learning experiences that build confidence, character, and competence in every student, preparing them for success in an interconnected world.');
        $school->setVision('To prepare confident, competent, and compassionate leaders who can excel in a global environment while contributing positively to their communities and upholding strong moral values.');
        $school->setPrincipalMessage('Welcome to Global Talent School! At GTS, we believe that every child is unique and possesses unlimited potential. Our mission is to unlock that potential through innovative teaching methods, personalized attention, and a nurturing environment. We are committed to providing education that not only focuses on academic excellence but also on building character, confidence, and global citizenship. Together, let us shape the future leaders of tomorrow.');
        
        $this->em->persist($school);

        // Create Courses
        $courses = [
            /*['Playgroup', 'Early childhood program focusing on foundational skills through play and exploration.', 1],*/
            ['Nursery', 'Building social skills and basic literacy in a fun, interactive environment.', 2],
            ['KG (Kindergarten)', 'Comprehensive kindergarten program preparing children for formal schooling.', 3],
            ['Grade 1', 'Introduction to formal education with emphasis on reading, writing, and mathematics.', 4],
            ['Grade 2', 'Building upon foundational skills with enhanced curriculum and activities.', 5],
            ['Grade 3', 'Developing critical thinking and problem-solving abilities across all subjects.', 6],
            ['Grade 4', 'Intermediate level education with focus on academic depth and breadth.', 7],
            ['Grade 5', 'Advanced primary education preparing students for middle school.', 8],
            ['Grade 6', 'Middle school curriculum with specialized subject teachers.', 9],
            ['Grade 7', 'Pre-secondary education focusing on comprehensive subject knowledge.', 10],
            ['Grade 8', 'Final year of middle school preparing students for secondary education.', 11],
            ['Grade 9', 'The first year of secondary education where students begin specialized subjects and develop critical thinking skills.', 12],

        ];

        foreach ($courses as [$title, $description, $order]) {
            $course = new Course();
            $course->setTitle($title);
            $course->setDescription($description);
            $course->setNote('Includes: Activity-Based Learning • ESL (English as Second Language) • Computer Education');
            $course->setDisplayOrder($order);
            $this->em->persist($course);
        }

        // Create News
        $news1 = new News();
        $news1->setTitle('Admissions Open for Academic Year 2026!');
        $news1->setContent('We are excited to announce that admissions are now open for the academic year 2026 at Global Talent School! We welcome students from Playgroup to Grade 8, with limited seats available in each class.

Our comprehensive admission process ensures that we understand each child\'s unique needs and potential. Parents are encouraged to visit our campus to experience our facilities and meet our dedicated faculty.

Key highlights of our admission process:
- Personal interviews with parents and students
- Campus tour and facility demonstration
- Discussion of curriculum and teaching methodology
- Transparent fee structure
- Flexible payment plans available

Don\'t miss this opportunity to be part of the GTS family. Contact us today to schedule your visit!');
        $news1->setExcerpt('Secure your child\'s future! Admissions now open for 2026. Limited seats available from Playgroup to Grade 8.');
        $news1->setDate(new \DateTime('2025-01-15'));
        $this->em->persist($news1);

        $news2 = new News();
        $news2->setTitle('Annual Day Celebration 2025 - A Grand Success!');
        $news2->setContent('Global Talent School celebrated its Annual Day 2025 with great enthusiasm and grandeur. The event showcased the incredible talents of our students through various performances including traditional dances, skits, music performances, and English speeches.

Parents, teachers, and students gathered to celebrate a year of achievements and memorable moments. The highlight of the evening was the awards ceremony recognizing outstanding academic performance, sports achievements, and exemplary character.

The event concluded with a vote of thanks from our Principal, acknowledging the hard work of students, dedication of teachers, and unwavering support of parents. We look forward to another successful year ahead!');
        $news2->setExcerpt('A memorable celebration of talent, achievement, and community spirit at Global Talent School\'s Annual Day 2025.');
        $news2->setDate(new \DateTime('2025-01-10'));
        $this->em->persist($news2);

        $news3 = new News();
        $news3->setTitle('Expansion Announcement: Grades 9 & 10 Coming Soon!');
        $news3->setContent('We are thrilled to announce a major milestone for Global Talent School - the expansion of our academic programs to include Grades 9 and 10!

This expansion represents our commitment to providing continuous, quality education to our students as they progress through their academic journey. Students will no longer need to seek education elsewhere after completing Grade 8.

Our secondary education program will feature:
- Science and Computer Science streams
- Experienced secondary-level faculty
- Enhanced laboratory facilities
- Career counseling and guidance
- Preparation for board examinations

Construction of new facilities is already underway, and we expect to welcome our first batch of Grade 9 students in the upcoming academic year. Stay tuned for more updates!');
        $news3->setExcerpt('Big news! GTS is expanding to offer complete secondary education with Grades 9 & 10 starting next year.');
        $news3->setDate(new \DateTime('2025-01-05'));
        $this->em->persist($news3);

        $this->em->flush();

        $io->success('Initial data has been set up successfully!');
        $io->info('Created: 1 School, ' . count($courses) . ' Courses, 3 News items');

        return Command::SUCCESS;
    }
}