# Events

Asset Count provides events for extending its functionality. Modules and plugins can register event listeners, typically in their `init()` methods, to change Asset Count’s behaviour.

## Count Events

### The `afterResetCount` Event
The event that is triggered after an asset’s view count is reset, such as through the **Reset Asset Count** element action.

The event’s `assetId` property holds the ID of the asset whose count was reset. The count record is already deleted when the event is triggered, so the listener can’t prevent the reset.

```php
use verbb\assetcount\events\ResetCountEvent;
use verbb\assetcount\services\Service;
use yii\base\Event;

Event::on(Service::class, Service::EVENT_AFTER_RESET_COUNT, function(ResetCountEvent $event) {
    $assetId = $event->assetId;
    \Craft::info("Reset the view count for asset {$assetId}.", __METHOD__);
});
```
