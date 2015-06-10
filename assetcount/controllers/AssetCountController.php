<?php
namespace Craft;

/**
 * Asset Count Controller
 */
class AssetCountController extends BaseController
{
    protected $allowAnonymous = array('actionCount');
    
    /**
     * Reset count
     */
    public function actionReset()
    {
        $assetId = craft()->request->getRequiredParam('assetId');

        craft()->assetCount->reset($assetId);

        craft()->userSession->setNotice(Craft::t('Asset count reset.'));

        $this->redirect('assetcount');
    }

    public function actionCount()
    {
        $assetId = craft()->request->getRequiredParam('id');

        craft()->assetCount->increment($assetId);

        $asset = craft()->assets->getFileById($assetId);

        $this->redirect($asset->url);
    }

}
