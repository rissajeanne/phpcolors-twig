<?php
/**
 * PHPColors plugin for Craft CMS 3.x
 *
 * A Twig extension wrapper for phpColors by Mexitek
 *
 * @link      https://agathongroup.com
 * @copyright Copyright (c) 2020 Marissa Yuen
 */

namespace rissajeanne\phpcolorstwig\twigextensions;

use rissajeanne\phpcolors\PHPColors;
use Mexitek\PHPColors\Color;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Craft;

/**
 * @author    Marissa Yuen
 * @package   PHPColors
 * @since     0.1.0
 */
class PHPColorsTwigExtension extends AbstractExtension
{
    // Private Properties
    // =========================================================================

    /**
     * @var Mexitek\PHPColors\Color
     */
    private $_color = null;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'PHPColors';
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('isDark', [$this, 'isDark']),
            new TwigFunction('isLight', [$this, 'isLight']),
        ];
    }

    // Protected Methods
    // =========================================================================

    /**
     * Is this a dark color value?
     */
    protected function isDark(string $hex = '#000000'): bool
    {
        $this->initialize($hex);
        return $this->_color->isDark();
    }

    /**
     * Is this a light color value?
     */
    protected function isLight(string $hex = '#000000'): bool
    {
        $this->initialize($hex);
        return $this->_color->isLight();
    }

    // Private Methods
    // =========================================================================

    /**
     * @return void
     */
    private function initialize(string $hex = '#000000')
    {
        if (!($this->_color && $this->_color->getHex() == str_replace('#', '', $hex))) {
            $this->_color = new Color($hex);
        }
    }
}
