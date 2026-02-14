<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // 1. Super Admin (has all permissions)
        $superAdmin = new User();
        $superAdmin->setEmail('superadmin@globaltalentschool.edu.pk');
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $superAdmin->setPassword($this->passwordHasher->hashPassword($superAdmin, 'SuperAdmin123!'));
        $manager->persist($superAdmin);

        // 2. Admin (can manage everything)
        $admin = new User();
        $admin->setEmail('admin@globaltalentschool.edu.pk');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'Admin123!'));
        $manager->persist($admin);

        // 3. Admissions Officer (can manage admissions)
        $admissions = new User();
        $admissions->setEmail('admissions@globaltalentschool.edu.pk');
        $admissions->setRoles(['ROLE_ADMISSIONS']);
        $admissions->setPassword($this->passwordHasher->hashPassword($admissions, 'Admissions123!'));
        $manager->persist($admissions);

        // 4. Faculty Member (teachers)
        $faculty = new User();
        $faculty->setEmail('teacher@globaltalentschool.edu.pk');
        $faculty->setRoles(['ROLE_FACULTY']);
        $faculty->setPassword($this->passwordHasher->hashPassword($faculty, 'Teacher123!'));
        $manager->persist($faculty);

        // 5. Student
        $student = new User();
        $student->setEmail('student@globaltalentschool.edu.pk');
        $student->setRoles(['ROLE_STUDENT']);
        $student->setPassword($this->passwordHasher->hashPassword($student, 'Student123!'));
        $manager->persist($student);

        // 6. Test accounts (for development)
        $testAdmin = new User();
        $testAdmin->setEmail('test@admin.com');
        $testAdmin->setRoles(['ROLE_ADMIN']);
        $testAdmin->setPassword($this->passwordHasher->hashPassword($testAdmin, 'test123'));
        $manager->persist($testAdmin);

        $manager->flush();

        // Output success message
        echo "\n✅ Users created successfully:\n";
        echo "   Super Admin: superadmin@globaltalentschool.edu.pk / SuperAdmin123!\n";
        echo "   Admin: admin@globaltalentschool.edu.pk / Admin123!\n";
        echo "   Admissions: admissions@globaltalentschool.edu.pk / Admissions123!\n";
        echo "   Faculty: teacher@globaltalentschool.edu.pk / Teacher123!\n";
        echo "   Student: student@globaltalentschool.edu.pk / Student123!\n";
        echo "   Test Admin: test@admin.com / test123\n\n";
    }
}