<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190704095319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, job_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, company VARCHAR(255) NOT NULL, claimant_name VARCHAR(255) NOT NULL, relevant_site VARCHAR(255) NOT NULL, is_eligible_cir TINYINT(1) NOT NULL, as_part_of_pulpit TINYINT(1) NOT NULL, deadline DATETIME NOT NULL, documents VARCHAR(255) NOT NULL, activity_type VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EEBE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, activity_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_527EDB2581C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, job_id INT NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', smartphone_id VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, is_eligible TINYINT(1) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, username_canonical VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), UNIQUE INDEX UNIQ_957A64797BA2F5EB (api_token), INDEX IDX_957A6479BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE working_time (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, project_id INT NOT NULL, task_id INT NOT NULL, date DATETIME NOT NULL, spent_time INT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_31EE2ABFA76ED395 (user_id), INDEX IDX_31EE2ABF166D1F9C (project_id), INDEX IDX_31EE2ABF8DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE working_time ADD CONSTRAINT FK_31EE2ABFA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE working_time ADD CONSTRAINT FK_31EE2ABF166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE working_time ADD CONSTRAINT FK_31EE2ABF8DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2581C06096');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEBE04EA9');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479BE04EA9');
        $this->addSql('ALTER TABLE working_time DROP FOREIGN KEY FK_31EE2ABF166D1F9C');
        $this->addSql('ALTER TABLE working_time DROP FOREIGN KEY FK_31EE2ABF8DB60186');
        $this->addSql('ALTER TABLE working_time DROP FOREIGN KEY FK_31EE2ABFA76ED395');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE working_time');
    }
}
