<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112131417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person_covid DROP FOREIGN KEY FK_795F635C217BBB47');
        $this->addSql('ALTER TABLE person_location DROP FOREIGN KEY FK_CAD82CFC217BBB47');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, gender VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP INDEX UNIQ_795F635C217BBB47 ON person_covid');
        $this->addSql('ALTER TABLE person_covid CHANGE person_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE person_covid ADD CONSTRAINT FK_795F635CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_795F635CA76ED395 ON person_covid (user_id)');
        $this->addSql('DROP INDEX IDX_CAD82CFC217BBB47 ON person_location');
        $this->addSql('ALTER TABLE person_location CHANGE person_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE person_location ADD CONSTRAINT FK_CAD82CFCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CAD82CFCA76ED395 ON person_location (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person_covid DROP FOREIGN KEY FK_795F635CA76ED395');
        $this->addSql('ALTER TABLE person_location DROP FOREIGN KEY FK_CAD82CFCA76ED395');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, birthday DATE NOT NULL, gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_795F635CA76ED395 ON person_covid');
        $this->addSql('ALTER TABLE person_covid CHANGE user_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE person_covid ADD CONSTRAINT FK_795F635C217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_795F635C217BBB47 ON person_covid (person_id)');
        $this->addSql('DROP INDEX IDX_CAD82CFCA76ED395 ON person_location');
        $this->addSql('ALTER TABLE person_location CHANGE user_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE person_location ADD CONSTRAINT FK_CAD82CFC217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CAD82CFC217BBB47 ON person_location (person_id)');
    }
}
