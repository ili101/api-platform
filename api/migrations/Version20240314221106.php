<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314221106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE main_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sun_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tip_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE main (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sun (id INT NOT NULL, main_id INT NOT NULL, tip_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51B4CEF7627EA78A ON sun (main_id)');
        $this->addSql('CREATE INDEX IDX_51B4CEF7476C47F6 ON sun (tip_id)');
        $this->addSql('CREATE TABLE tip (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE sun ADD CONSTRAINT FK_51B4CEF7627EA78A FOREIGN KEY (main_id) REFERENCES main (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sun ADD CONSTRAINT FK_51B4CEF7476C47F6 FOREIGN KEY (tip_id) REFERENCES tip (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE main_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sun_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tip_id_seq CASCADE');
        $this->addSql('ALTER TABLE sun DROP CONSTRAINT FK_51B4CEF7627EA78A');
        $this->addSql('ALTER TABLE sun DROP CONSTRAINT FK_51B4CEF7476C47F6');
        $this->addSql('DROP TABLE main');
        $this->addSql('DROP TABLE sun');
        $this->addSql('DROP TABLE tip');
    }
}
