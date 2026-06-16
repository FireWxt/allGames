<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260616084049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_232B318C3E2E969B ON game');
        $this->addSql('ALTER TABLE game DROP review_id');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE genre_game ADD CONSTRAINT FK_98C6E87C4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_game ADD CONSTRAINT FK_98C6E87CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_794381C6E48FD905 ON review (game_id)');
        $this->addSql('ALTER TABLE whislist_item ADD CONSTRAINT FK_6C965ED7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE whislist_item ADD CONSTRAINT FK_6C965ED7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6995AC4C');
        $this->addSql('ALTER TABLE game ADD review_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_232B318C3E2E969B ON game (review_id)');
        $this->addSql('ALTER TABLE genre_game DROP FOREIGN KEY FK_98C6E87C4296D31F');
        $this->addSql('ALTER TABLE genre_game DROP FOREIGN KEY FK_98C6E87CE48FD905');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6E48FD905');
        $this->addSql('DROP INDEX IDX_794381C6E48FD905 ON review');
        $this->addSql('ALTER TABLE review DROP game_id');
        $this->addSql('ALTER TABLE whislist_item DROP FOREIGN KEY FK_6C965ED7A76ED395');
        $this->addSql('ALTER TABLE whislist_item DROP FOREIGN KEY FK_6C965ED7E48FD905');
    }
}
