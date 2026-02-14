<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260124000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial schema for Global Talent School';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE school (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            address LONGTEXT NOT NULL,
            phone VARCHAR(50) DEFAULT NULL,
            email VARCHAR(100) DEFAULT NULL,
            whatsapp VARCHAR(50) DEFAULT NULL,
            logo VARCHAR(255) DEFAULT NULL,
            about_text LONGTEXT DEFAULT NULL,
            mission LONGTEXT DEFAULT NULL,
            vision LONGTEXT DEFAULT NULL,
            principal_message LONGTEXT DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE course (
            id INT AUTO_INCREMENT NOT NULL,
            title VARCHAR(255) NOT NULL,
            description LONGTEXT DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            note LONGTEXT DEFAULT NULL,
            display_order INT NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE faculty (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            designation VARCHAR(255) DEFAULT NULL,
            bio LONGTEXT DEFAULT NULL,
            photo VARCHAR(255) DEFAULT NULL,
            display_order INT NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE news (
            id INT AUTO_INCREMENT NOT NULL,
            title VARCHAR(255) NOT NULL,
            content LONGTEXT NOT NULL,
            excerpt LONGTEXT DEFAULT NULL,
            date DATE NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE gallery_image (
            id INT AUTO_INCREMENT NOT NULL,
            title VARCHAR(255) NOT NULL,
            image VARCHAR(255) NOT NULL,
            category VARCHAR(100) DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE inquiry (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(50) DEFAULT NULL,
            message LONGTEXT NOT NULL,
            type VARCHAR(50) NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE faculty');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE gallery_image');
        $this->addSql('DROP TABLE inquiry');
    }
}