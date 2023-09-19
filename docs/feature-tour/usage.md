# Usage
In order to count a directly accessed Asset, you will need to alter the `url` that the asset points to. This is so that the view is tracked before presenting the user with the original asset as intended.

So, instead of a link to the asset such as:

```twig
<a href="{{ file.url }}" target="_blank"></a>
```

You'll need to change it to:

```twig
{% set file = craft.assets.id(1234).one() %}

<a href="{{ actionUrl('asset-count/count', { id: file.id }) }}" target="_blank"></a>

// Or with a Twig filter
<a href="{{ file | asset_count }}" target="_blank"></a>

// Or with a Twig function
<a href="{{ asset_count(file) }}" target="_blank"></a>
```
