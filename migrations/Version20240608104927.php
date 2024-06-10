<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608104927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alimentation_jour (id INT AUTO_INCREMENT NOT NULL, nourriture VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', quantite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, alimentation_jour_id INT DEFAULT NULL, rapport_animal_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, UNIQUE INDEX UNIQ_6AAB231FF76D8F97 (alimentation_jour_id), INDEX IDX_6AAB231F8DF40EFA (rapport_animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_8F91ABF08E962C16 (animal_id), INDEX IDX_8F91ABF0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, rapoort_habitat_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3B37B2E88E962C16 (animal_id), INDEX IDX_3B37B2E816ABBD85 (rapoort_habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_animal (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) DEFAULT NULL, nourriture_propose VARCHAR(255) DEFAULT NULL, grammage_nourriture VARCHAR(255) DEFAULT NULL, detail_etat_animal VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_habitat (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, rapport_animal_id INT DEFAULT NULL, rapport_habitat_id INT DEFAULT NULL, alimentation_jour_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, INDEX IDX_8D93D6498DF40EFA (rapport_animal_id), INDEX IDX_8D93D649641E157 (rapport_habitat_id), INDEX IDX_8D93D649F76D8F97 (alimentation_jour_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FF76D8F97 FOREIGN KEY (alimentation_jour_id) REFERENCES alimentation_jour (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8DF40EFA FOREIGN KEY (rapport_animal_id) REFERENCES rapport_animal (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF08E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E88E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E816ABBD85 FOREIGN KEY (rapoort_habitat_id) REFERENCES rapport_habitat (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498DF40EFA FOREIGN KEY (rapport_animal_id) REFERENCES rapport_animal (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649641E157 FOREIGN KEY (rapport_habitat_id) REFERENCES rapport_habitat (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F76D8F97 FOREIGN KEY (alimentation_jour_id) REFERENCES alimentation_jour (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FF76D8F97');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8DF40EFA');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF08E962C16');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E88E962C16');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E816ABBD85');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498DF40EFA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649641E157');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F76D8F97');
        $this->addSql('DROP TABLE alimentation_jour');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE habitat');
        $this->addSql('DROP TABLE rapport_animal');
        $this->addSql('DROP TABLE rapport_habitat');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
