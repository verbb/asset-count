<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use Craft;
use craft\web\Controller;

class CountController extends Controller
{
    // Properties
    // =========================================================================

    protected $allowAnonymous = true;


    // Public Methods
    // =========================================================================

    public function actionIndex()
    {
        $assetId = Craft::$app->getRequest()->getRequiredParam('id');

        AssetCount::$plugin->getService()->increment($assetId);

        $asset = Craft::$app->getAssets()->getAssetById($assetId);

        return $this->redirect($asset->url);
    }
}