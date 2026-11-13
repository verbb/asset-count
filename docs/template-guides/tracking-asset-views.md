# Tracking Asset Views

Asset Count stores a running total for each asset. The [tracked download link](docs:feature-tour/usage) adds to it whenever someone opens the file through it. In your templates, you can show an asset's total, count a view from your own page, and list the assets people open most.

## Showing an Asset's View Count

`craft.assetCount.getCount(assetId)` takes an asset's ID and returns its count. Output it directly and you get the number. An asset nobody has opened yet returns `0`, so you don't need to check for a missing count first.

This example belongs in an entry template whose entry type has an Assets field with the handle `document`. It shows a tracked download link with the count beside it.

```twig
{% set asset = entry.document.one() %}

{% if asset %}
    {% set views = craft.assetCount.getCount(asset.id) %}

    <p>
        <a href="{{ asset | asset_count }}">Download {{ asset.title }}</a>
        ({{ views.count }} {{ views.count == 1 ? 'view' : 'views' }})
    </p>
{% endif %}
```

A PDF opened 42 times shows as “Download Annual Report (42 views)”. Reading the count doesn't add a view, and the view from clicking the link shows the next time the page loads.

The value `getCount()` returns has a `count` property holding the total, which is what `{{ views }}` outputs too. Use `views.count` when you compare or calculate with it, as the example does. It also has `dateUpdated`, the date the count last changed, which is empty for an asset that hasn't been counted yet.

## Counting a View From Your Template

The tracked link counts a view when someone clicks it. Sometimes the view happens on your own page instead, such as a video or an image gallery shown in place, where nobody follows a link. Call `craft.assetCount.increment(assetId)` in that page's template to add one to the asset's count each time the page renders. It outputs nothing.

This example is for an entry template with an Assets field called `video`, which plays the video on the page.

```twig
{% set video = entry.video.one() %}

{% if video %}
    {% do craft.assetCount.increment(video.id) %}

    <video src="{{ video.url }}" controls></video>
    <p>{{ craft.assetCount.getCount(video.id) }} views</p>
{% endif %}
```

`increment()` follows the same settings as the tracked link, so it skips signed-in users, bots and IP addresses you've told it to ignore under [Configuration](docs:get-started/configuration). It counts every render of the template, including page reloads. It doesn't run when the page is served from a cache, such as a `{% cache %}` tag around the call or a static page cache, so keep it outside any cached part of the template.

Only use one way of counting for each asset on a page. If the page calls `increment()` and also links to the file with `asset_count`, a visitor who loads the page and then clicks the link adds two views.

## Listing the Most Viewed Assets

`craft.assetCount.getAssets()` returns an [asset query](https://craftcms.com/docs/5.x/reference/element-types/assets.html#querying-assets) for every asset that has a count, ordered from the most viewed to the least. Assets nobody has opened aren't included, and neither are assets whose count has been reset. You can add any asset query parameter before fetching the results, such as `limit()` or `kind()`.

This example shows the five most downloaded PDFs, for a sidebar or a resources page.

```twig
{% set popularFiles = craft.assetCount.getAssets()
    .kind('pdf')
    .limit(5)
    .all() %}

<h2>Popular Downloads</h2>

<ol>
    {% for file in popularFiles %}
        <li>
            <a href="{{ file | asset_count }}">{{ file.title }}</a>
            ({{ craft.assetCount.getCount(file.id) }} downloads)
        </li>
    {% else %}
        <li>No files have been downloaded yet.</li>
    {% endfor %}
</ol>
```

Each item links through the tracked URL, so downloads from the list are counted too. Until anything has been opened, the list shows “No files have been downloaded yet.”

The query keeps the most-viewed order as long as you don't add your own `orderBy()`, which replaces it.
