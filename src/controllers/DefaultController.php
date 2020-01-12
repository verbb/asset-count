<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use Craft;
use craft\web\Controller;

class DefaultController extends Controller
{
    // Public Methods
    // =========================================================================

    public function actionSettings()
    {
        $settings = AssetCount::$plugin->getSettings();

        $this->renderTemplate('asset-count/settings', [
            'settings' => $settings,
        ]);
    }
}