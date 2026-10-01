<?php
namespace verbb\assetcount\events;

use yii\base\Event;

class ResetCountEvent extends Event
{
    // Properties
    // =========================================================================

    public int $assetId;
}
