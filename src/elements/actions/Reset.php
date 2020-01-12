<?php
namespace verbb\assetcount\elements\actions;

use verbb\assetcount\AssetCount;

use Craft;
use craft\base\ElementAction;
use craft\elements\db\ElementQueryInterface;

class Reset extends ElementAction
{
    // Public Methods
    // =========================================================================

    public function getTriggerLabel(): string
    {
        return Craft::t('asset-count', 'Reset Asset Count');
    }

    public static function isDestructive(): bool
    {
        return true;
    }

    public function performAction(ElementQueryInterface $query): bool
    {
        $service = AssetCount::$plugin->getService();

        foreach ($query->all() as $element) {
            $service->reset($element->id);
        }

        $this->setMessage(Craft::t('asset-count', 'Asset Count Successfully Reset'));

        return true;
    }
}
