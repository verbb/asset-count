<?php
namespace verbb\assetcount\models;

use craft\base\Model;

class AssetCountModel extends Model
{
    // Public Properties
    // =========================================================================

    public ?string $id = null;
    public ?string $assetId = null;
    public int $count = 0;
    public ?DateTIme $dateCreated = null;
    public ?DateTIme $dateUpdated = null;


    // Public Methods
    // =========================================================================

    public function __toString(): string
    {
        return (string)$this->count;
    }
}