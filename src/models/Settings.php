<?php
namespace verbb\assetcount\models;

use craft\base\Model;

class Settings extends Model
{
    // Public Properties
    // =========================================================================

    public bool $showCountOnAssetIndex = true;
    public bool $ignoreLoggedInUsers = false;
    public bool $ignoreIpAddresses = false;

}
