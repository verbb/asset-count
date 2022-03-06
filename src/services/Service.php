<?php
namespace verbb\assetcount\services;

use verbb\assetcount\AssetCount;
use verbb\assetcount\models\AssetCountModel;
use verbb\assetcount\records\AssetCountRecord;

use Craft;
use craft\base\Component;
use craft\elements\db\AssetQuery;
use craft\elements\Asset;

use yii\base\Event;

class Service extends Component
{
    // Constants
    // =========================================================================

    public const EVENT_AFTER_RESET_COUNT = 'afterResetCount';


    // Public Methods
    // =========================================================================

    public function getCount($assetId): AssetCountModel
    {
        $assetCountModel = new AssetCountModel();

        $assetCountRecord = AssetCountRecord::find()
            ->where(['assetId' => $assetId])
            ->one();

        if ($assetCountRecord) {
            $assetCountModel->setAttributes($assetCountRecord->getAttributes(), false);
        }

        return $assetCountModel;
    }

    public function getAssets(): AssetQuery
    {
        $assetCountRecords = AssetCountRecord::find()
            ->orderBy('count desc')
            ->all();

        $assetIds = [];

        foreach ($assetCountRecords as $assetCountRecord) {
            $assetIds[] = $assetCountRecord->assetId;
        }

        return Asset::find()
            ->id($assetIds)
            ->fixedOrder(true);
    }

    public function increment($assetId): void
    {
        if ($this->_ignoreAction()) {
            return;
        }

        $assetCountRecord = AssetCountRecord::find()
            ->where(['assetId' => $assetId])
            ->one();

        // If exists then increment count, otherwise create a new record
        if ($assetCountRecord) {
            $assetCountRecord->setAttribute('count', $assetCountRecord->getAttribute('count') + 1);
        } else {
            $assetCountRecord = new AssetCountRecord;
            $assetCountRecord->setAttribute('assetId', $assetId);
            $assetCountRecord->setAttribute('count', 1);
        }

        $assetCountRecord->save();
    }

    public function reset($assetId): void
    {
        $assetCountRecord = AssetCountRecord::find()
            ->where(['assetId' => $assetId])
            ->one();

        if ($assetCountRecord) {
            $assetCountRecord->delete();
        }

        // Fire a 'afterResetCount' event
        if ($this->hasEventHandlers(self::EVENT_AFTER_RESET_COUNT)) {
            $this->trigger(self::EVENT_AFTER_RESET_COUNT, new Event([
                'assetId' => $assetId,
            ]));
        }
    }


    // Private methods
    // =========================================================================

    private function _ignoreAction(): bool
    {
        $settings = AssetCount::$plugin->getSettings();

        // Check if logged-in users should be ignored based on settings
        if ($settings->ignoreLoggedInUsers && !Craft::$app->getUser()->getIsGuest()) {
            return true;
        }

        // Check if ip address should be ignored based on settings
        return $settings->ignoreIpAddresses && in_array(Craft::$app->getRequest()->getUserIP(), explode("\n", $settings->ignoreIpAddresses), true);
    }
}