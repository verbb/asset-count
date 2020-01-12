<?php
namespace verbb\assetcount\variables;

use verbb\assetcount\AssetCount;

use Craft;

class AssetCountVariable
{
    // Public Methods
    // =========================================================================
    
    public function getCount($assetId)
    {
        return AssetCount::$plugin->getService()->getCount($assetId);
    }

    public function getAssets()
    {
        return AssetCount::$plugin->getService()->getAssets();
    }

    public function increment($assetId)
    {
        AssetCount::$plugin->getService()->increment($assetId);
    }
}
