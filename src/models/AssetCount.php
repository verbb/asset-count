<?php
namespace verbb\assetcount\models;

use craft\base\Model;

use DateTime;

class AssetCount extends Model
{
    // Properties
    // =========================================================================

    public ?string $assetId = null;
    public int $count = 0;
    public ?DateTime $dateCreated = null;
    public ?DateTime $dateUpdated = null;
    public ?string $id = null;


    // Public Methods
    // =========================================================================

    public function __toString(): string
    {
        return (string)$this->count;
    }
}