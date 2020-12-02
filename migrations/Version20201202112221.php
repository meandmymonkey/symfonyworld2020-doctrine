<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202112221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_task_item (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, list_id BIGINT UNSIGNED DEFAULT NULL, summary VARCHAR(255) NOT NULL, done TINYINT(1) NOT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C4C7EE503DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_task_list (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, name VARCHAR(255) NOT NULL, archived TINYINT(1) NOT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9F1433567E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_list_user (task_list_id BIGINT UNSIGNED NOT NULL, user_id INT UNSIGNED NOT NULL, INDEX IDX_B777C4F1224F3C61 (task_list_id), INDEX IDX_B777C4F1A76ED395 (user_id), PRIMARY KEY(task_list_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_88BDF3E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_task_item ADD CONSTRAINT FK_C4C7EE503DAE168B FOREIGN KEY (list_id) REFERENCES app_task_list (id)');
        $this->addSql('ALTER TABLE app_task_list ADD CONSTRAINT FK_9F1433567E3C61F9 FOREIGN KEY (owner_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE task_list_user ADD CONSTRAINT FK_B777C4F1224F3C61 FOREIGN KEY (task_list_id) REFERENCES app_task_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_list_user ADD CONSTRAINT FK_B777C4F1A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_task_item DROP FOREIGN KEY FK_C4C7EE503DAE168B');
        $this->addSql('ALTER TABLE task_list_user DROP FOREIGN KEY FK_B777C4F1224F3C61');
        $this->addSql('ALTER TABLE app_task_list DROP FOREIGN KEY FK_9F1433567E3C61F9');
        $this->addSql('ALTER TABLE task_list_user DROP FOREIGN KEY FK_B777C4F1A76ED395');
        $this->addSql('DROP TABLE app_task_item');
        $this->addSql('DROP TABLE app_task_list');
        $this->addSql('DROP TABLE task_list_user');
        $this->addSql('DROP TABLE app_user');
    }
}
