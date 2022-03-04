<?php
namespace verbb\assetcount\variables;

use verbb\assetcount\AssetCount;
use verbb\assetcount\models\AssetCountModel;

use craft\elements\db\AssetQuery;

class AssetCountVariable
{
    // Public Methods
    // =========================================================================

    public function getCount($assetId): AssetCountModel
    {
        return AssetCount::$plugin->getService()->getCount($assetId);
    }

    public function getAssets(): AssetQuery
    {
        return AssetCount::$plugin->getService()->getAssets();
    }

    public function increment($assetId): void
    {
        AssetCount::$plugin->getService()->increment($assetId);
    }
}
