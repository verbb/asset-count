<?php
namespace verbb\assetcount\base;

use verbb\assetcount\AssetCount;
use verbb\assetcount\services\Service;
use verbb\base\BaseHelper;

use Craft;

use yii\log\Logger;

trait PluginTrait
{
    // Properties
    // =========================================================================

    public static AssetCount $plugin;


    // Static Methods
    // =========================================================================

    public static function error(string $message, array $params = []): void
    {
        $message = Craft::t('asset-count', $message, $params);

        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'asset-count');
    }

    public static function log(string $message, array $params = []): void
    {
        $message = Craft::t('asset-count', $message, $params);

        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'asset-count');
    }


    // Public Methods
    // =========================================================================

    public function getService(): Service
    {
        return $this->get('service');
    }


    // Private Methods
    // =========================================================================

    private function _registerComponents(): void
    {
        $this->setComponents([
            'service' => Service::class,
        ]);

        BaseHelper::registerModule();
    }

    private function _registerLogTarget(): void
    {
        BaseHelper::setFileLogging('asset-count');
    }

}