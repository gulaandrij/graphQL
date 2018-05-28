<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180528115122 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE booking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE meeting_room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE booking (
          id INT NOT NULL, 
          user_id INT DEFAULT NULL, 
          meeting_room_id INT DEFAULT NULL, 
          start_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          end_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_E00CEDDEA76ED395 ON booking (user_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDECCC5381E ON booking (meeting_room_id)');
        $this->addSql('CREATE TABLE meeting_room (
          id INT NOT NULL, 
          name VARCHAR(200) NOT NULL, 
          created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE TABLE users (
          id INT NOT NULL, 
          username VARCHAR(180) NOT NULL, 
          username_canonical VARCHAR(180) NOT NULL, 
          email VARCHAR(180) NOT NULL, 
          email_canonical VARCHAR(180) NOT NULL, 
          enabled BOOLEAN NOT NULL, 
          salt VARCHAR(255) DEFAULT NULL, 
          password VARCHAR(255) NOT NULL, 
          last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
          confirmation_token VARCHAR(180) DEFAULT NULL, 
          password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
          roles TEXT NOT NULL, 
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E992FC23A8 ON users (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A0D96FBF ON users (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9C05FB297 ON users (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE 
          booking 
        ADD 
          CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE 
          booking 
        ADD 
          CONSTRAINT FK_E00CEDDECCC5381E FOREIGN KEY (meeting_room_id) REFERENCES meeting_room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDECCC5381E');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDEA76ED395');
        $this->addSql('DROP SEQUENCE booking_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE meeting_room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE meeting_room');
        $this->addSql('DROP TABLE users');
    }
}
