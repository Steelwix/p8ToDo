<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025075717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE migration_versions');
        $this->addSql('ALTER TABLE task ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2567B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_527EDB2567B3B43D ON task (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(14) NOT NULL, executed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(version))');
        $this->addSql('COMMENT ON COLUMN migration_versions.executed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB2567B3B43D');
        $this->addSql('DROP INDEX IDX_527EDB2567B3B43D');
        $this->addSql('ALTER TABLE task DROP users_id');
    }
}
