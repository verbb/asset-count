<?php
namespace Craft;

/**
 * Asset Count Service
 */
class AssetCountService extends BaseApplicationComponent
{
    /**
     * Returns count
     *
	 * @param int $assetId
	 *
	 * @return AssetCountModel
     */
    public function getCount($assetId)
    {
        // create new model
        $assetCountModel = new AssetCountModel();

        // get record from DB
        $assetCountRecord = AssetCountRecord::model()->findByAttributes(array('assetId' => $assetId));

        if ($assetCountRecord)
        {
            // populate model from record
            $assetCountModel = AssetCountModel::populateModel($assetCountRecord);
        }

        return $assetCountModel;
    }

    /**
     * Returns counted assets
     *
     * @return ElementCriteriaModel
     */
    public function getAssets()
    {
        // get all records from DB ordered by count descending
        $assetCountRecords = AssetCountRecord::model()->findAll(array(
            'order'=>'count desc'
        ));

        // get asset ids from records
        $assetIds = array();

        foreach ($assetCountRecords as $assetCountRecord)
        {
            $assetIds[] = $assetCountRecord->assetId;
        }

        // create criteria for asset element type
        $criteria = craft()->elements->getCriteria('Asset');

        // filter by asset ids
        $criteria->id = $assetIds;

        // enable fixed order
        $criteria->fixedOrder = true;

        return $criteria;
    }

    /**
     * Increment count
     *
	 * @param int $assetId
     */
    public function increment($assetId)
    {
        // check if action should be ignored
        if ($this->_ignoreAction())
        {
            return;
        }

        // get record from DB
        $assetCountRecord = AssetCountRecord::model()->findByAttributes(array('assetId' => $assetId));

        // if exists then increment count
        if ($assetCountRecord)
        {
            $assetCountRecord->setAttribute('count', $assetCountRecord->getAttribute('count') + 1);
        }

        // otherwise create a new record
        else
        {
            $assetCountRecord = new AssetCountRecord;
            $assetCountRecord->setAttribute('assetId', $assetId);
            $assetCountRecord->setAttribute('count', 1);
        }

        // save record in DB
        $assetCountRecord->save();
    }

    /**
     * Reset count
     *
	 * @param int $assetId
     */
    public function reset($assetId)
    {
        // get record from DB
        $assetCountRecord = AssetCountRecord::model()->findByAttributes(array('assetId' => $assetId));

        // if record exists then delete
        if ($assetCountRecord)
        {
            // delete record from DB
            $assetCountRecord->delete();
        }

        // log reset
        AssetCountPlugin::log(
            'Asset count with asset ID '.$assetId.' reset by '.craft()->userSession->getUser()->username,
            LogLevel::Info,
            true
        );

        // fire an onResetCount event
        $this->onResetCount(new Event($this, array('assetId' => $assetId)));
    }

    /**
     * On reset count
     *
     * @param Event $event
     */
    public function onResetCount($event)
    {
        $this->raiseEvent('onResetCount', $event);
    }

    // Helper methods
    // =========================================================================

    /**
     * Check if action should be ignored
     */
    private function _ignoreAction()
    {
        // get plugin settings
        $settings = craft()->plugins->getPlugin('assetCount')->getSettings();

        // check if logged in users should be ignored based on settings
        if ($settings->ignoreLoggedInUsers AND craft()->userSession->isLoggedIn())
        {
            return true;
        }

        // check if ip address should be ignored based on settings
        if ($settings->ignoreIpAddresses AND in_array(craft()->request->getIpAddress(), explode("\n", $settings->ignoreIpAddresses)))
        {
            return true;
        }
    }
}
