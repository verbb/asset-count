<?php
namespace verbb\assetcount\models;

use craft\base\Model;

class AssetCountModel extends Model
{
    // Public Properties
    // =========================================================================

    public $id;
    public $assetId;
    public $count = 0;
    public $dateCreated;
    public $dateUpdated;


    // Public Methods
    // =========================================================================

    public function __toString()
    {
        return (string)$this->count;
    }
}