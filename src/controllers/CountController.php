<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use Craft;
use craft\web\Controller;

use yii\web\NotFoundHttpException;
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
        $asset = Craft::$app->getAssets()->getAssetById($assetId);

        if (!$asset || !$asset->url) {
            throw new NotFoundHttpException();
        }

        AssetCount::$plugin->getService()->increment($assetId);

        return $this->redirect($asset->url);
    }
}