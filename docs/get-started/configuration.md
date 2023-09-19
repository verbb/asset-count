# Configuration
Create a `asset-count.php` file under your `/config` directory with the following options available to you. You can also use multi-environment options to change these per environment.

The below shows the defaults already used by Asset Count, so you don't need to add these options unless you want to modify the values.

```php
<?php

return [
    '*' => [
        'showCountOnAssetIndex' => true,
        'ignoreIpAddresses' => false,
        'ignoreLoggedInUsers' => false,
    ],
];
```

## Configuration options
- `showCountOnAssetIndex` - Will add a new column for the asset count on the asset index pages.
- `ignoreIpAddresses` - Add one IP address per line to ignore them when incrementing counts.
- `ignoreLoggedInUsers` - Only increment counts if users are not logged in.

## Control Panel
You can also manage configuration settings through the Control Panel by visiting Settings → Asset Count.
