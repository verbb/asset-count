<?php
namespace Craft;

class AssetCountPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Asset Count');
    }

    public function getVersion()
    {
        return '0.0.1';
    }

    public function getDeveloper()
    {
        return 'S. Group';
    }

    public function getDeveloperUrl()
    {
        return 'http://sgroup.com.au';
    }

    protected function defineSettings()
    {
        return array(
            'showCountOnAssetIndex' => array(AttributeType::Bool, 'default' => 0),
            'ignoreLoggedInUsers' => array(AttributeType::Bool, 'default' => 0),
            'ignoreIpAddresses' => array(AttributeType::Mixed, 'default' => '')
        );
    }

    public function getSettingsHtml()
    {
       return craft()->templates->render('assetcount/settings', array(
           'settings' => $this->getSettings()
       ));
    }

    public function hasCpSection()
    {
        return true;
    }

	// Hooks
	// =========================================================================

    public function modifyAssetTableAttributes(&$attributes, $source)
    {
        if ($this->getSettings()->showCountOnAssetIndex)
        {
            $attributes['count'] = Craft::t('Count');
        }
    }

    public function getAssetTableAttributeHtml($asset, $attribute)
    {
        if ($this->getSettings()->showCountOnAssetIndex AND $attribute == 'count')
        {
            return craft()->assetCount->getCount($asset->id)->count;
        }
    }

    public function addAssetActions($source)
    {
        if ($this->getSettings()->showCountOnAssetIndex)
        {
            return array('AssetCount_Reset');
        }
    }
}
