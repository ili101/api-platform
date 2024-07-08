<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240708230111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE main_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sub_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE main (id INT NOT NULL, sub1_id INT DEFAULT NULL, sub2_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF28CD6429662E71 ON main (sub1_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF28CD643BD3819F ON main (sub2_id)');
        $this->addSql('CREATE TABLE sub (id INT NOT NULL, main_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_580282DC627EA78A ON sub (main_id)');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD6429662E71 FOREIGN KEY (sub1_id) REFERENCES sub (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD643BD3819F FOREIGN KEY (sub2_id) REFERENCES sub (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub ADD CONSTRAINT FK_580282DC627EA78A FOREIGN KEY (main_id) REFERENCES main (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE main_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sub_id_seq CASCADE');
        $this->addSql('ALTER TABLE main DROP CONSTRAINT FK_BF28CD6429662E71');
        $this->addSql('ALTER TABLE main DROP CONSTRAINT FK_BF28CD643BD3819F');
        $this->addSql('ALTER TABLE sub DROP CONSTRAINT FK_580282DC627EA78A');
        $this->addSql('DROP TABLE main');
        $this->addSql('DROP TABLE sub');
    }
}
