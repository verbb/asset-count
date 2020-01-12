# Asset Count for Craft CMS

A Craft CMS plugin that allows you to count and display the number of times that an asset has been viewed.

In order to count a directly accessed Asset, you will need to alter the `url` that the asset points to. This is so that the view is tracked before presenting the user with the original asset as intended.

So, instead of a link to the asset such as:

```
<a href="{{ file.url }}" target="_blank"></a>
```

You'll need to change it to:

```
{% set file = craft.assets.id(1234).one() %}

<a href="{{ actionUrl('asset-count/count', { id: file.id }) }}" target="_blank"></a>

// Or with Twig filter
<a href="{{ file | asset_count }}" target="_blank"></a>

// Or with Twig function
<a href="{{ asset_count(file) }}" target="_blank"></a>

```

## Installation
You can install Asset Count via the plugin store, or through Composer.

### Craft Plugin Store
To install **Asset Count**, navigate to the _Plugin Store_ section of your Craft control panel, search for `Asset Count`, and click the _Try_ button.

### Composer
You can also add the package to your project using Composer.

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:
    
        composer require verbb/asset-count

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Asset Count.

## Show your Support

Asset Count is licensed under the MIT license, meaning it will always be free and open source – we love free stuff! If you'd like to show your support to the plugin regardless, buy us a :beers:. Please note that this does not entitle you to any form of support, and is completely optional.

[![Beerpay](https://beerpay.io/verbb/asset-count/badge.svg?style=beer-square)](https://beerpay.io/verbb/asset-count)

<h2></h2>

<a href="https://verbb.io" target="_blank">
  <img width="100" src="https://verbb.io/assets/img/verbb-pill.svg">
</a>

## Credit & Thanks

Thanks to [Ben Croker](https://github.com/putyourlightson) for the [Entry Count Plugin](https://github.com/putyourlightson/craft-entry-count).
