<?php
/**
 * Element Cache Buster plugin for Craft CMS 3.x
 *
 * Enables cache busting on the Elements API. Bust the cache when a section, field or entry is updated.
 *
 * @link      https://everyday.no
 * @copyright Copyright (c) 2020 Everyday AS
 */

namespace everyday\ElementCacheBuster;

use everyday\ElementCacheBuster\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\ProjectConfig;
use craft\services\Elements;
use craft\services\Structures;
use yii\base\InvalidConfigException;

/**
 * Class ElementCacheBuster
 *
 * @author    Everyday AS
 * @package   ElementCacheBuster
 * @since     1.0.0
 *
 */
class ElementCacheBuster extends Plugin
{
    /**
     * @var ElementCacheBuster
     */
    public static $plugin;

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $settings = $this->getSettings();

        if ($settings->enabled) {
            $invalidate = [$this, 'invalidateCaches'];

            $projectConfig = Craft::$app->get('projectConfig');
            $elements = Craft::$app->get('elements');
            $structures = Craft::$app->get('structures');

            $projectConfig->on(ProjectConfig::EVENT_ADD_ITEM, $invalidate);
            $projectConfig->on(ProjectConfig::EVENT_REMOVE_ITEM, $invalidate);
            $projectConfig->on(ProjectConfig::EVENT_UPDATE_ITEM, $invalidate);
            $projectConfig->on(ProjectConfig::EVENT_REBUILD, $invalidate);
            $projectConfig->on(ProjectConfig::EVENT_AFTER_APPLY_CHANGES, $invalidate);
            $elements->on(Elements::EVENT_AFTER_SAVE_ELEMENT, $invalidate);
            $elements->on(Elements::EVENT_AFTER_DELETE_ELEMENT, $invalidate);
            $structures->on(Structures::EVENT_AFTER_MOVE_ELEMENT, $invalidate);
        }
    }

    /**
     * Invalidates all caches
     */
    public function invalidateCaches()
    {
        $cacheService = Craft::$app->getCache();
        $cacheService->flush();
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'element-cache-buster/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
