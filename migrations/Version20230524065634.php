<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230524065634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(512) NOT NULL, created_at DATETIME NOT NULL, started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', finished_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_64C19C1B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(512) NOT NULL, description VARCHAR(512) DEFAULT NULL, status SMALLINT NOT NULL, INDEX IDX_A8BCA4512469DE2 (category_id), INDEX IDX_A8BCA45A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temporary_user_coin (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, idea_id INT DEFAULT NULL, spent_coin INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F49018A612469DE2 (category_id), INDEX IDX_F49018A6A76ED395 (user_id), INDEX IDX_F49018A65B6FEF7D (idea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, total_coins INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_coin_history (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, idea_id INT DEFAULT NULL, coin INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E87A5DB8A76ED395 (user_id), INDEX IDX_E87A5DB812469DE2 (category_id), INDEX IDX_E87A5DB85B6FEF7D (idea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE idea ADD CONSTRAINT FK_A8BCA4512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE idea ADD CONSTRAINT FK_A8BCA45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE temporary_user_coin ADD CONSTRAINT FK_F49018A612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE temporary_user_coin ADD CONSTRAINT FK_F49018A6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE temporary_user_coin ADD CONSTRAINT FK_F49018A65B6FEF7D FOREIGN KEY (idea_id) REFERENCES idea (id)');
        $this->addSql('ALTER TABLE user_coin_history ADD CONSTRAINT FK_E87A5DB8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_coin_history ADD CONSTRAINT FK_E87A5DB812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user_coin_history ADD CONSTRAINT FK_E87A5DB85B6FEF7D FOREIGN KEY (idea_id) REFERENCES idea (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1B03A8386');
        $this->addSql('ALTER TABLE idea DROP FOREIGN KEY FK_A8BCA4512469DE2');
        $this->addSql('ALTER TABLE idea DROP FOREIGN KEY FK_A8BCA45A76ED395');
        $this->addSql('ALTER TABLE temporary_user_coin DROP FOREIGN KEY FK_F49018A612469DE2');
        $this->addSql('ALTER TABLE temporary_user_coin DROP FOREIGN KEY FK_F49018A6A76ED395');
        $this->addSql('ALTER TABLE temporary_user_coin DROP FOREIGN KEY FK_F49018A65B6FEF7D');
        $this->addSql('ALTER TABLE user_coin_history DROP FOREIGN KEY FK_E87A5DB8A76ED395');
        $this->addSql('ALTER TABLE user_coin_history DROP FOREIGN KEY FK_E87A5DB812469DE2');
        $this->addSql('ALTER TABLE user_coin_history DROP FOREIGN KEY FK_E87A5DB85B6FEF7D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE idea');
        $this->addSql('DROP TABLE temporary_user_coin');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_coin_history');
    }
}
