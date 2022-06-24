<?php
namespace verbb\assetcount\twigextensions;

use craft\elements\Asset;
use craft\helpers\UrlHelper;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

class Extension extends Twig_Extension
{
    // Public Methods
    // =========================================================================

    public function getName(): string
    {
        return 'Asset Count';
    }

    public function getFilters(): array
    {
        return [
            new Twig_SimpleFilter('asset_count', [$this, 'getAssetCountUrl']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new Twig_SimpleFunction('asset_count', [$this, 'getAssetCountUrl']),
        ];
    }

    public function getAssetCountUrl($asset): string
    {
        if (!$asset || !is_a($asset, Asset::class) || !$asset->url) {
            return '';
        }

        return UrlHelper::actionUrl('asset-count/count', ['id' => $asset->id]);
    }
}
