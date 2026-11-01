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
        $assetId = filter_var(Craft::$app->getRequest()->getRequiredParam('id'), FILTER_VALIDATE_INT);
        $asset = $assetId ? Craft::$app->getAssets()->getAssetById($assetId) : null;

        if (!$asset || !$asset->url) {
            throw new NotFoundHttpException();
        }

        AssetCount::$plugin->getService()->increment($assetId);

        return $this->redirect($asset->url);
    }
}
