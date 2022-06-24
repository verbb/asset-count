<?php
namespace verbb\assetcount\migrations;

use Craft;
use craft\db\Migration;

class Install extends Migration
{
    // Public Methods
    // =========================================================================

    public function safeUp(): bool
    {
        if (!$this->db->tableExists('{{%assetcount}}')) {
            $this->createTable('{{%assetcount}}', [
                'id' => $this->primaryKey(),
                'assetId' => $this->integer()->notNull(),
                'count' => $this->integer()->defaultValue(0)->notNull(),
                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid' => $this->uid(),
            ]);

            $this->createIndex(null, '{{%assetcount}}', 'assetId', true);

            $this->addForeignKey(null, '{{%assetcount}}', 'assetId', '{{%elements}}', 'id', 'CASCADE');

            Craft::$app->getDb()->schema->refresh();
        }

        return true;
    }

    public function safeDown(): bool
    {
        $this->dropTableIfExists('{{%assetcount}}');

        return true;
    }
}