<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\GalleryImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Sample gallery images
        $categories = ['events', 'classrooms', 'activities'];
        $imageData = [
            ['Annual Day 2024', 'events'],
            ['Sports Day', 'events'],
            ['Science Fair', 'events'],
            ['Classroom Activities', 'classrooms'],
            ['Computer Lab', 'classrooms'],
            ['Library', 'classrooms'],
            ['Art Class', 'activities'],
            ['Music Class', 'activities'],
            ['Field Trip', 'activities'],
        ];

        foreach ($imageData as $index => [$title, $category]) {
            $image = new GalleryImage();
            $image->setTitle($title);
            $image->setCategory($category);
            // Placeholder image - replace with actual paths
            $image->setImage('placeholder-' . ($index + 1) . '.jpg');
            $manager->persist($image);
        }

        $manager->flush();
    }
}