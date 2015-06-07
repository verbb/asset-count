<?php
namespace Craft;

/**
 * Asset Count Variable
 */
class AssetCountVariable
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
        return craft()->assetCount->getCount($assetId);
    }

    /**
     * Returns counted assets
     *
     * @return ElementCriteriaModel
     */
    public function getAssets()
    {
        return craft()->assetCount->getAssets();
    }

    /**
     * Increment count
     *
	 * @param int $assetId
     */
    public function increment($assetId)
    {
        craft()->assetCount->increment($assetId);
    }

}
