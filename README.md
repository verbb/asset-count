#Asset Count

Asset Count is a Craft CMS plugin that allows you to count and display the number of times that an asset has been viewed.

In order to count a directly accessed Asset, you will need to alter the `url` that the asset points to. This is so that the view is tracked before presenting the user with the original asset as intended.

So, instead of a link to the asset such as:

```
 <a href="{{ file.url }}" target="_blank"></a>
```

You'll need to change it to:

```
 <a href="{{ actionUrl('assetCount/count', { id: file.id }) }}" target="_blank"></a>
```

## Credit & Thanks

A massive thanks to [Ben Croker](https://github.com/putyourlightson) for the [Entry Count Plugin](https://github.com/putyourlightson/craft-entry-count). Without his plugin and hard work, this one wouldn't exist.

While you're at it - check out Ben's [Craft Plugin Development video course](https://mijingo.com/products/screencasts/craft-plugin-development/) where you'll learn to create plugins just like this one and more.
