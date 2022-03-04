<?php
namespace verbb\assetcount;

use verbb\assetcount\base\PluginTrait;
use verbb\assetcount\elements\actions\Reset;
use verbb\assetcount\models\Settings;
use verbb\assetcount\twigextensions\Extension;
use verbb\assetcount\variables\AssetCountVariable;
use verbb\assetcount\controllers\DefaultController;

use Craft;
use craft\base\Element;
use craft\base\Model;
use craft\base\Plugin;
use craft\elements\Asset;
use craft\events\RegisterElementActionsEvent;
use craft\events\RegisterElementTableAttributesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\SetElementTableAttributeHtmlEvent;
use craft\helpers\UrlHelper;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

class AssetCount extends Plugin
{
    // Properties
    // =========================================================================

    public bool $hasCpSettings = true;
    public string $schemaVersion = '1.0.0';


    // Traits
    // =========================================================================

    use PluginTrait;


    // Public Methods
    // =========================================================================

    public function init(): void
    {
        parent::init();

        self::$plugin = $this;

        $this->_setPluginComponents();
        $this->_setLogging();
        $this->_registerTwigExtensions();
        $this->_registerCpRoutes();
        $this->_registerVariable();
        $this->_registerEventHandlers();
    }

    public function getSettingsResponse(): mixed
    {
        return Craft::$app->getResponse()->redirect(UrlHelper::cpUrl('asset-count/settings'));
    }


    // Protected Methods
    // =========================================================================

    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }


    // Private Methods
    // =========================================================================

    private function _registerTwigExtensions(): void
    {
        Craft::$app->getView()->registerTwigExtension(new Extension);
    }

    private function _registerVariable(): void
    {
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            $event->sender->set('assetCount', AssetCountVariable::class);
        });
    }

    private function _registerCpRoutes(): void
    {
        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $event) {
            $event->rules = array_merge($event->rules, [
                'asset-count/settings' => 'asset-count/default/settings',
            ]);
        });
    }

    private function _registerEventHandlers(): void
    {
        $settings = $this->getSettings();

        if ($settings->showCountOnAssetIndex) {
            Event::on(Asset::class, Element::EVENT_REGISTER_TABLE_ATTRIBUTES, function(RegisterElementTableAttributesEvent $event) {
                $event->tableAttributes['count'] = ['label' => Craft::t('asset-count', 'View Count')];
            });

            Event::on(Asset::class, Element::EVENT_SET_TABLE_ATTRIBUTE_HTML, function(SetElementTableAttributeHtmlEvent $event) {
                if ($event->attribute === 'count') {
                    $asset = $event->sender;

                    $event->html = AssetCount::$plugin->getService()->getCount($asset->id)->count;
                }
            });

            Event::on(Asset::class, Element::EVENT_REGISTER_ACTIONS, function(RegisterElementActionsEvent $event) {
                $event->actions[] = new Reset();
            });
        }
    }
}
