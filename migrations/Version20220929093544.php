<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929093544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `product` table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product 
            (
                id CHAR(36) NOT NULL, 
                name VARCHAR(100) NOT NULL, 
                sku VARCHAR(50) NOT NULL, 
                price DOUBLE PRECISION NOT NULL, 
                created_at DATETIME NOT NULL, 
                INDEX IDX_product_sku (sku), 
                INDEX IDX_product_price (price), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
    }
}
