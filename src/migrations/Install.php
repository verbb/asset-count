<?php
namespace verbb\assetcount\migrations;

use Craft;
use craft\db\Migration;
use craft\helpers\MigrationHelper;

class Install extends Migration
{
    // Public Methods
    // =========================================================================

    public function safeUp(): bool
    {
        $this->createTables();
        $this->createIndexes();
        $this->addForeignKeys();

        return true;
    }

    public function safeDown(): bool
    {
        $this->dropForeignKeys();
        $this->dropTables();

        return true;
    }

    public function createTables(): void
    {
        $this->archiveTableIfExists('{{%assetcount}}');
        $this->createTable('{{%assetcount}}', [
            'id' => $this->primaryKey(),
            'assetId' => $this->integer()->notNull(),
            'count' => $this->integer()->defaultValue(0)->notNull(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);
    }

    public function createIndexes(): void
    {
        $this->createIndex(null, '{{%assetcount}}', 'assetId', true);
    }

    public function addForeignKeys(): void
    {
        $this->addForeignKey(null, '{{%assetcount}}', 'assetId', '{{%elements}}', 'id', 'CASCADE');
    }

    public function dropTables(): void
    {
        $this->dropTableIfExists('{{%assetcount}}');
    }

    public function dropForeignKeys(): void
    {
        if ($this->db->tableExists('{{%assetcount}}')) {
            MigrationHelper::dropAllForeignKeysOnTable('{{%assetcount}}', $this);
        }
    }
}