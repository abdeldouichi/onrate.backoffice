<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212143250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D51A5AA3');
        $this->addSql('DROP INDEX IDX_8D93D649D51A5AA3 ON user');
        $this->addSql('ALTER TABLE user DROP users_mock_id, CHANGE name username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD users_mock_id INT DEFAULT NULL, CHANGE username name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D51A5AA3 FOREIGN KEY (users_mock_id) REFERENCES mock_user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D51A5AA3 ON user (users_mock_id)');
    }
}
