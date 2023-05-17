<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230517152710 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `navigation_item` (
                id INT AUTO_INCREMENT NOT NULL, 
                title LONGTEXT NOT NULL, 
                type LONGTEXT NOT NULL, 
                slug LONGTEXT NOT NULL, 
                path LONGTEXT NOT NULL, 
                created_at DATETIME NOT NULL, 
                updated_at DATETIME NOT NULL, 
                PRIMARY KEY(id)
           ) 
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `navigation_item`');
    }
}
