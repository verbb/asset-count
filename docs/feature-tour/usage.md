# Usage

Asset Count tracks visits through a special asset link, then sends the visitor to the original file. Use that link wherever you want to count downloads. A visitor who opens the original asset URL directly bypasses the counter.

For example, add an Assets field with the handle `download` to an entry type and select a PDF. In the entry's Twig template, fetch the selected asset and pass it through the `asset_count` filter:

```twig
{% set file = entry.download.one() %}

{% if file %}
    <a href="{{ file | asset_count }}">Download {{ file.title }}</a>
{% endif %}
```

The condition hides the link when no file has been selected. Clicking it records a view before opening the PDF. You can use the function form, `asset_count(file)`, instead of the filter if you prefer.

The same tracked URL can be generated explicitly with Craft's action URL helper:

```twig
{% if file %}
    <a href="{{ actionUrl('asset-count/count', { id: file.id }) }}">
        Download {{ file.title }}
    </a>
{% endif %}
```

Open the link and check that it reaches the selected file. To display the recorded total alongside the download, follow [Tracking Asset Views](docs:template-guides/tracking-asset-views).
