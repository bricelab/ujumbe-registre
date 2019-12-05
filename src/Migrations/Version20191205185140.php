<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205185140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA gestion_registre');
        $this->addSql('CREATE SEQUENCE gestion_registre.category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.classeur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.correspondant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.courrier_arrive_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.courrier_depart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.registre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.secretariat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.type_courrier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.type_registre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gestion_registre.category (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C3B5985A4D60759 ON gestion_registre.category (libelle)');
        $this->addSql('CREATE TABLE gestion_registre.classeur (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B28C31EA4D60759 ON gestion_registre.classeur (libelle)');
        $this->addSql('CREATE TABLE gestion_registre.correspondant (id INT NOT NULL, nom_complet VARCHAR(255) NOT NULL, adresse TEXT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE gestion_registre.courrier_arrive (id INT NOT NULL, sender_id INT NOT NULL, type_id INT NOT NULL, category_id INT NOT NULL, classeur_id INT DEFAULT NULL, registre_id INT NOT NULL, received_at DATE NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, chrono VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, courrier_date DATE NOT NULL, objet TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_45BAFCDEF624B39D ON gestion_registre.courrier_arrive (sender_id)');
        $this->addSql('CREATE INDEX IDX_45BAFCDEC54C8C93 ON gestion_registre.courrier_arrive (type_id)');
        $this->addSql('CREATE INDEX IDX_45BAFCDE12469DE2 ON gestion_registre.courrier_arrive (category_id)');
        $this->addSql('CREATE INDEX IDX_45BAFCDEEC10E96A ON gestion_registre.courrier_arrive (classeur_id)');
        $this->addSql('CREATE INDEX IDX_45BAFCDE5678EFCA ON gestion_registre.courrier_arrive (registre_id)');
        $this->addSql('CREATE TABLE gestion_registre.courrier_depart (id INT NOT NULL, type_id INT NOT NULL, category_id INT NOT NULL, classeur_id INT DEFAULT NULL, registre_id INT NOT NULL, send_at DATE NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, chrono VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, courrier_date DATE NOT NULL, objet TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D715A3AC54C8C93 ON gestion_registre.courrier_depart (type_id)');
        $this->addSql('CREATE INDEX IDX_6D715A3A12469DE2 ON gestion_registre.courrier_depart (category_id)');
        $this->addSql('CREATE INDEX IDX_6D715A3AEC10E96A ON gestion_registre.courrier_depart (classeur_id)');
        $this->addSql('CREATE INDEX IDX_6D715A3A5678EFCA ON gestion_registre.courrier_depart (registre_id)');
        $this->addSql('CREATE TABLE gestion_registre.destinataires_courrier_depart (courrier_depart_id INT NOT NULL, correspondant_id INT NOT NULL, PRIMARY KEY(courrier_depart_id, correspondant_id))');
        $this->addSql('CREATE INDEX IDX_53121BE84018DBC2 ON gestion_registre.destinataires_courrier_depart (courrier_depart_id)');
        $this->addSql('CREATE INDEX IDX_53121BE8BBE04A3B ON gestion_registre.destinataires_courrier_depart (correspondant_id)');
        $this->addSql('CREATE TABLE gestion_registre.registre (id INT NOT NULL, secretariat_id INT NOT NULL, type_id INT NOT NULL, numero VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83DE0101A628C492 ON gestion_registre.registre (secretariat_id)');
        $this->addSql('CREATE INDEX IDX_83DE0101C54C8C93 ON gestion_registre.registre (type_id)');
        $this->addSql('CREATE TABLE gestion_registre.secretariat (id INT NOT NULL, nom VARCHAR(255) NOT NULL, sigle VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE gestion_registre.type_courrier (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_548636E9A4D60759 ON gestion_registre.type_courrier (libelle)');
        $this->addSql('CREATE TABLE gestion_registre.type_registre (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, type VARCHAR(10) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33DB0B06A4D60759 ON gestion_registre.type_registre (libelle)');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive ADD CONSTRAINT FK_45BAFCDEF624B39D FOREIGN KEY (sender_id) REFERENCES gestion_registre.correspondant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive ADD CONSTRAINT FK_45BAFCDEC54C8C93 FOREIGN KEY (type_id) REFERENCES gestion_registre.type_courrier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive ADD CONSTRAINT FK_45BAFCDE12469DE2 FOREIGN KEY (category_id) REFERENCES gestion_registre.category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive ADD CONSTRAINT FK_45BAFCDEEC10E96A FOREIGN KEY (classeur_id) REFERENCES gestion_registre.classeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive ADD CONSTRAINT FK_45BAFCDE5678EFCA FOREIGN KEY (registre_id) REFERENCES gestion_registre.registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart ADD CONSTRAINT FK_6D715A3AC54C8C93 FOREIGN KEY (type_id) REFERENCES gestion_registre.type_courrier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart ADD CONSTRAINT FK_6D715A3A12469DE2 FOREIGN KEY (category_id) REFERENCES gestion_registre.category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart ADD CONSTRAINT FK_6D715A3AEC10E96A FOREIGN KEY (classeur_id) REFERENCES gestion_registre.classeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart ADD CONSTRAINT FK_6D715A3A5678EFCA FOREIGN KEY (registre_id) REFERENCES gestion_registre.registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.destinataires_courrier_depart ADD CONSTRAINT FK_53121BE84018DBC2 FOREIGN KEY (courrier_depart_id) REFERENCES gestion_registre.courrier_depart (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.destinataires_courrier_depart ADD CONSTRAINT FK_53121BE8BBE04A3B FOREIGN KEY (correspondant_id) REFERENCES gestion_registre.correspondant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.registre ADD CONSTRAINT FK_83DE0101A628C492 FOREIGN KEY (secretariat_id) REFERENCES gestion_registre.secretariat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gestion_registre.registre ADD CONSTRAINT FK_83DE0101C54C8C93 FOREIGN KEY (type_id) REFERENCES gestion_registre.type_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        //$this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive DROP CONSTRAINT FK_45BAFCDE12469DE2');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart DROP CONSTRAINT FK_6D715A3A12469DE2');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive DROP CONSTRAINT FK_45BAFCDEEC10E96A');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart DROP CONSTRAINT FK_6D715A3AEC10E96A');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive DROP CONSTRAINT FK_45BAFCDEF624B39D');
        $this->addSql('ALTER TABLE gestion_registre.destinataires_courrier_depart DROP CONSTRAINT FK_53121BE8BBE04A3B');
        $this->addSql('ALTER TABLE gestion_registre.destinataires_courrier_depart DROP CONSTRAINT FK_53121BE84018DBC2');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive DROP CONSTRAINT FK_45BAFCDE5678EFCA');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart DROP CONSTRAINT FK_6D715A3A5678EFCA');
        $this->addSql('ALTER TABLE gestion_registre.registre DROP CONSTRAINT FK_83DE0101A628C492');
        $this->addSql('ALTER TABLE gestion_registre.courrier_arrive DROP CONSTRAINT FK_45BAFCDEC54C8C93');
        $this->addSql('ALTER TABLE gestion_registre.courrier_depart DROP CONSTRAINT FK_6D715A3AC54C8C93');
        $this->addSql('ALTER TABLE gestion_registre.registre DROP CONSTRAINT FK_83DE0101C54C8C93');
        $this->addSql('DROP SEQUENCE gestion_registre.category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.classeur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.correspondant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.courrier_arrive_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.courrier_depart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.registre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.secretariat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.type_courrier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.type_registre_id_seq CASCADE');
        $this->addSql('DROP TABLE gestion_registre.category');
        $this->addSql('DROP TABLE gestion_registre.classeur');
        $this->addSql('DROP TABLE gestion_registre.correspondant');
        $this->addSql('DROP TABLE gestion_registre.courrier_arrive');
        $this->addSql('DROP TABLE gestion_registre.courrier_depart');
        $this->addSql('DROP TABLE gestion_registre.destinataires_courrier_depart');
        $this->addSql('DROP TABLE gestion_registre.registre');
        $this->addSql('DROP TABLE gestion_registre.secretariat');
        $this->addSql('DROP TABLE gestion_registre.type_courrier');
        $this->addSql('DROP TABLE gestion_registre.type_registre');
    }
}
