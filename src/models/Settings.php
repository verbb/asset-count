<?php
namespace verbb\assetcount\models;

use craft\base\Model;

class Settings extends Model
{
    // Public Properties
    // =========================================================================

    public $showCountOnAssetIndex = true;
    public $ignoreLoggedInUsers = false;
    public $ignoreIpAddresses;

}
