<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use Craft;
use craft\web\Controller;

use yii\web\Response;

class ResetController extends Controller
{
    // Public Methods
    // =========================================================================

    public function actionIndex(): Response
    {
        $assetId = Craft::$app->getRequest()->getRequiredParam('id');

        AssetCount::$plugin->getService()->reset($assetId);

        Craft::$app->getSession()->setNotice(Craft::t('asset-count', 'Asset count reset.'));

        return $this->redirect('asset-count');
    }
}