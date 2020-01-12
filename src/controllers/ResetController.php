<?php
namespace verbb\assetcount\controllers;

use verbb\assetcount\AssetCount;

use Craft;
use craft\web\Controller;

class ResetController extends Controller
{
    // Public Methods
    // =========================================================================

    public function actionIndex()
    {
        $assetId = Craft::$app->getRequest()->getRequiredParam('id');

        AssetCount::$plugin->getService()->reset($assetId);

        Craft::$app->getSession()->setNotice(Craft::t('asset-count', 'Asset count reset.'));

        return $this->redirect('asset-count');
    }
}