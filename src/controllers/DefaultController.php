<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use craft\web\Controller;

use yii\web\Response;

class DefaultController extends Controller
{
    // Public Methods
    // =========================================================================

    public function actionSettings(): Response
    {
        $settings = AssetCount::$plugin->getSettings();

        return $this->renderTemplate('asset-count/settings', [
            'settings' => $settings,
        ]);
    }
}