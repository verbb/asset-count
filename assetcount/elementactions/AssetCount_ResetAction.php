<?php
namespace Craft;

/**
 * Asset Count Reset Action
 */
class AssetCount_ResetAction extends BaseElementAction
{
    /**
     * Get name
	 *
	 * @return string
     */
	public function getName()
	{
		return Craft::t('Reset Asset Count');
	}

    /**
     * Is destructive
     *
     * @return bool
     */
    public function isDestructive()
    {
        return true;
    }

    /**
     * Perform action
	 *
	 * @param ElementCriteriaModel $criteria
	 *
	 * @return bool
     */
	public function performAction(ElementCriteriaModel $criteria)
	{
        $assets = $criteria->find();

        foreach ($assets as $asset)
        {
            craft()->assetCount->reset($asset->id);
        }

		$this->setMessage(Craft::t('Asset Count Successfully Reset'));

		return true;
	}
}
