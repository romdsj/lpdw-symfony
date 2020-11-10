<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110094419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person_location (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, location_id INT NOT NULL, visited_at DATETIME NOT NULL, INDEX IDX_CAD82CFC217BBB47 (person_id), INDEX IDX_CAD82CFC64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_location ADD CONSTRAINT FK_CAD82CFC217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE person_location ADD CONSTRAINT FK_CAD82CFC64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE person_location');
    }
}
