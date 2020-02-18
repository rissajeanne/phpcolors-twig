<?php
/**
 * PHPColors plugin for Craft CMS 3.x
 *
 * A Twig extension wrapper for phpColors by Mexitek
 *
 * @link      https://agathongroup.com
 * @copyright Copyright (c) 2020 Marissa Yuen
 */

namespace rissajeanne\phpcolorstwig;

use rissajeanne\phpcolorstwig\twigextensions\PHPColorsTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class PHPColors
 *
 * @author    Marissa Yuen
 * @package   PHPColors
 * @since     0.1.0
 *
 */
class PHPColors extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var PHPColors
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '0.1.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        if (Craft::$app->request->getIsSiteRequest()) {
            Craft::$app->view->registerTwigExtension(new PHPColorsTwigExtension());
        }

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'phpcolorstwig',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================
}
