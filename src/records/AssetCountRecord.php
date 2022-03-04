<?php
namespace verbb\assetcount\records;

use craft\db\ActiveRecord;

class AssetCountRecord extends ActiveRecord
{
    // Static Methods
    // =========================================================================

    public static function tableName(): string
    {
        return '{{%assetcount}}';
    }
}