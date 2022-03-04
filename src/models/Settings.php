<?php
namespace verbb\assetcount\models;

use craft\base\Model;

class Settings extends Model
{
    // Properties
    // =========================================================================

    public bool $ignoreIpAddresses = false;
    public bool $ignoreLoggedInUsers = false;
    public bool $showCountOnAssetIndex = true;

}
