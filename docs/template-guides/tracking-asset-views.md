# Tracking Asset Views

Use an asset ID to read its stored count. Increment the count only at the point your site treats as a view or download; reading a count should not itself add another view. For an asset relation field named `document` on the current entry:

```twig
{% set asset = entry.document.one() %}
{% if asset %}
    <p>{{ craft.assetCount.getCount(asset.id) }} views</p>
{% endif %}
```

## Calls Used in This Task

### `craft.assetCount.getCount(assetId)`
Returns the view count for the provided `assetId`.

### `craft.assetCount.increment(assetId)`
Increments the view count for the provided `assetId`.
