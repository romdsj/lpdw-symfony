<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116092441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account ADD person_id INT NOT NULL');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_7D3656A4217BBB47 ON account (person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4217BBB47');
        $this->addSql('DROP INDEX IDX_7D3656A4217BBB47 ON account');
        $this->addSql('ALTER TABLE account DROP person_id');
    }
}
