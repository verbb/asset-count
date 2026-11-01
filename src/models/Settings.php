<?php
namespace verbb\assetcount\models;

use craft\base\Model;

class Settings extends Model
{
    // Properties
    // =========================================================================

    public bool $ignoreBots = false;
    public string $ignoreIpAddresses = '';
    public bool $ignoreLoggedInUsers = false;
    public bool $showCountOnAssetIndex = true;

}
