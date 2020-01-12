<?php
namespace verbb\assetcount\assetbundles;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class AssetCountAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    public function init()
    {
        $this->sourcePath = "@verbb/assetcount/resources/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/asset-count.css',
        ];

        parent::init();
    }
}
