<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use Craft;
use craft\web\Controller;

use yii\web\Response;

class CountController extends Controller
{
    // Properties
    // =========================================================================

    protected array|int|bool $allowAnonymous = true;


    // Public Methods
    // =========================================================================

    public function actionIndex(): Response
    {
        $assetId = Craft::$app->getRequest()->getRequiredParam('id');

        AssetCount::$plugin->getService()->increment($assetId);

        $asset = Craft::$app->getAssets()->getAssetById($assetId);

        return $this->redirect($asset->url);
    }
}