<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217141155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE gestion_registre.registre DROP CONSTRAINT fk_83de0101c54c8c93');
        // $this->addSql('DROP SEQUENCE messenger_messages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gestion_registre.type_registre_id_seq CASCADE');
        $this->addSql('DROP TABLE gestion_registre.type_registre');
        // $this->addSql('DROP TABLE messenger_messages');
        // $this->addSql('DROP INDEX idx_83de0101c54c8c93');
        $this->addSql('ALTER TABLE gestion_registre.registre ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE gestion_registre.registre ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE gestion_registre.registre DROP type_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // $this->addSql('CREATE SCHEMA public');
        // $this->addSql('CREATE SEQUENCE messenger_messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gestion_registre.type_registre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gestion_registre.type_registre (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, type VARCHAR(10) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_33db0b06a4d60759 ON gestion_registre.type_registre (libelle)');
        // $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE INDEX idx_75ea56e0e3bd61ce ON messenger_messages (available_at)');
        // $this->addSql('CREATE INDEX idx_75ea56e016ba31db ON messenger_messages (delivered_at)');
        // $this->addSql('CREATE INDEX idx_75ea56e0fb7336f0 ON messenger_messages (queue_name)');
        $this->addSql('ALTER TABLE gestion_registre.registre ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE gestion_registre.registre DROP type');
        $this->addSql('ALTER TABLE gestion_registre.registre DROP status');
        $this->addSql('ALTER TABLE gestion_registre.registre ADD CONSTRAINT fk_83de0101c54c8c93 FOREIGN KEY (type_id) REFERENCES gestion_registre.type_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_83de0101c54c8c93 ON gestion_registre.registre (type_id)');
    }
}
