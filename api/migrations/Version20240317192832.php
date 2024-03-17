<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240317192832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE one_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE one (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE main DROP CONSTRAINT fk_bf28cd6456992d9');
        $this->addSql('DROP INDEX idx_bf28cd6456992d9');
        $this->addSql('ALTER TABLE main RENAME COLUMN sub_id TO one_id');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64FB9ACE13 FOREIGN KEY (one_id) REFERENCES one (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BF28CD64FB9ACE13 ON main (one_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE main DROP CONSTRAINT FK_BF28CD64FB9ACE13');
        $this->addSql('DROP SEQUENCE one_id_seq CASCADE');
        $this->addSql('DROP TABLE one');
        $this->addSql('DROP INDEX IDX_BF28CD64FB9ACE13');
        $this->addSql('ALTER TABLE main RENAME COLUMN one_id TO sub_id');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT fk_bf28cd6456992d9 FOREIGN KEY (sub_id) REFERENCES sub (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_bf28cd6456992d9 ON main (sub_id)');
    }
}
