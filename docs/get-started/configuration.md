# Configuration

You can customise Asset Count’s settings using a PHP configuration file. This is optional: each setting has a default, so you only need to include the values you want to change.

To override a setting, create `asset-count.php` in your Craft project’s `/config` directory and return an array of setting names and values. For example, the following will ignore downloads identified as bots:

```php
<?php

return [
    'ignoreBots' => true,
];
```

All other settings keep their defaults. Add any further settings you want to change to the same array. The options below explain the available settings and their defaults.

## Configuration Options

::: reference
### `showCountOnAssetIndex`

**Type:** `bool` · **Default:** `true`

Will add a new column for the asset count on the asset index pages.
:::

::: reference
### `ignoreIpAddresses`

**Type:** `bool` · **Default:** `false`

Add one IP address per line to ignore them when incrementing counts.
:::

::: reference
### `ignoreLoggedInUsers`

**Type:** `bool` · **Default:** `false`

Only increment counts if users are not logged in.
:::

::: reference
### `ignoreBots`

**Type:** `bool` · **Default:** `false`

Only increment counts if the request does not appear to be from a bot, crawler or spider.
:::


## Control Panel
You can also manage configuration settings through the Control Panel by visiting Settings → Asset Count.
