<?php
namespace verbb\assetcount\twigextensions;

use craft\elements\Asset;
use craft\helpers\UrlHelper;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    public function getName(): string
    {
        return 'Asset Count';
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('asset_count', fn($asset): string => $this->getAssetCountUrl($asset)),
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_count', fn($asset): string => $this->getAssetCountUrl($asset)),
        ];
    }

    public function getAssetCountUrl($asset): string
    {
        if (!$asset || !is_a($asset, Asset::class) || !$asset->getUrl()) {
            return '';
        }

        return UrlHelper::actionUrl('asset-count/count', ['id' => $asset->getId()]);
    }
}
