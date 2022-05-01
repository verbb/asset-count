<?php
namespace verbb\assetcount\records;

use craft\db\ActiveRecord;

class AssetCount extends ActiveRecord
{
    // Static Methods
    // =========================================================================

    public static function tableName(): string
    {
        return '{{%assetcount}}';
    }
}