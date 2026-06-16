<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260616100000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing game foreign keys for reviews and wishlist items.';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('review')) {
            $reviewTable = $schema->getTable('review');
            $reviewColumns = $reviewTable->getColumns();
            $reviewIndexes = array_map(static fn ($index) => $index->getName(), $reviewTable->getIndexes());
            $reviewForeignKeys = array_map(static fn ($foreignKey) => $foreignKey->getName(), $reviewTable->getForeignKeys());

            if (!isset($reviewColumns['game_id'])) {
                $this->addSql('ALTER TABLE review ADD game_id INT DEFAULT NULL');
            }

            if (!in_array('IDX_794381C6E48FD905', $reviewIndexes, true)) {
                $this->addSql('CREATE INDEX IDX_794381C6E48FD905 ON review (game_id)');
            }

            if (!in_array('FK_794381C6E48FD905', $reviewForeignKeys, true)) {
                $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
            }
        }

        if ($schema->hasTable('whislist_item')) {
            $wishlistTable = $schema->getTable('whislist_item');
            $wishlistColumns = $wishlistTable->getColumns();
            $wishlistIndexes = array_map(static fn ($index) => $index->getName(), $wishlistTable->getIndexes());
            $wishlistForeignKeys = array_map(static fn ($foreignKey) => $foreignKey->getName(), $wishlistTable->getForeignKeys());

            if (!isset($wishlistColumns['game_id'])) {
                $this->addSql('ALTER TABLE whislist_item ADD game_id INT DEFAULT NULL');
            }

            if (!in_array('IDX_6C965ED7E48FD905', $wishlistIndexes, true)) {
                $this->addSql('CREATE INDEX IDX_6C965ED7E48FD905 ON whislist_item (game_id)');
            }

            if (!in_array('FK_6C965ED7E48FD905', $wishlistForeignKeys, true)) {
                $this->addSql('ALTER TABLE whislist_item ADD CONSTRAINT FK_6C965ED7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
            }
        }
    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('review')) {
            $reviewTable = $schema->getTable('review');
            $reviewColumns = $reviewTable->getColumns();

            if (isset($reviewColumns['game_id'])) {
                $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6E48FD905');
                $this->addSql('DROP INDEX IDX_794381C6E48FD905 ON review');
                $this->addSql('ALTER TABLE review DROP game_id');
            }
        }

        if ($schema->hasTable('whislist_item')) {
            $wishlistTable = $schema->getTable('whislist_item');
            $wishlistColumns = $wishlistTable->getColumns();

            if (isset($wishlistColumns['game_id'])) {
                $this->addSql('ALTER TABLE whislist_item DROP FOREIGN KEY FK_6C965ED7E48FD905');
                $this->addSql('DROP INDEX IDX_6C965ED7E48FD905 ON whislist_item');
                $this->addSql('ALTER TABLE whislist_item DROP game_id');
            }
        }
    }
}