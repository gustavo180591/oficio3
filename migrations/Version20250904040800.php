<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250904040800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add created_at and updated_at columns to registro table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE registro ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE registro ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE registro DROP created_at, DROP updated_at');
    }
}
