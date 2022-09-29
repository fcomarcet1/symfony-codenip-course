<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220929132341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change the type of the price column of the product table from float to integer';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product CHANGE price price INT NOT NULL');
        /*
         * we change the type of the price column from float to integer,
         * we need to multiply the price by 100 to get the correct value in cents
         */
        $this->addSql('UPDATE product SET price = price * 100');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product CHANGE price price DOUBLE PRECISION NOT NULL');
    }
}
