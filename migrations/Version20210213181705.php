<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210213181705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE louer (id INT AUTO_INCREMENT NOT NULL, locataire_id INT DEFAULT NULL, voiture_id INT DEFAULT NULL, nbr_jour INT DEFAULT NULL, date_location DATE DEFAULT NULL, INDEX IDX_D1EAF4DD8A38199 (locataire_id), INDEX IDX_D1EAF4D181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, design VARCHAR(255) DEFAULT NULL, loyer INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE louer ADD CONSTRAINT FK_D1EAF4DD8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE louer ADD CONSTRAINT FK_D1EAF4D181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE louer DROP FOREIGN KEY FK_D1EAF4DD8A38199');
        $this->addSql('ALTER TABLE louer DROP FOREIGN KEY FK_D1EAF4D181A8BA');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE louer');
        $this->addSql('DROP TABLE voiture');
    }
}
