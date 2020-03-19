<?php
/**
 * Element Cache Buster plugin for Craft CMS 3.x
 *
 * Enables cache busting on the Elements API. Bust the cache when a section, field or entry is updated.
 *
 * @link      https://everyday.no
 * @copyright Copyright (c) 2020 Everyday AS
 */

namespace everyday\ElementCacheBuster\models;

use craft\base\Model;

/**
 * @author    Everyday AS
 * @package   ElementCacheBuster
 * @since     1.0.0
 */
class Settings extends Model
{
    /**
     * @var string
     */
    public $enabled = true;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['enabled', 'boolean']
        ];
    }
}
