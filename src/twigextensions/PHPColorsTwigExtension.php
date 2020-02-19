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
            new TwigFunction('darken', [$this, 'darken']),
            new TwigFunction('lighten', [$this, 'lighten']),
            new TwigFunction('mixColor', [$this, 'mix']),
            new TwigFunction('isDark', [$this, 'isDark']),
            new TwigFunction('isLight', [$this, 'isLight']),
            new TwigFunction('makeGradient', [$this, 'makeGradient']),
            new TwigFunction('complementary', [$this, 'complementary']),
            new TwigFunction('getHex', [$this, 'getHex']),
            new TwigFunction('getHsl', [$this, 'getHsl']),
            new TwigFunction('getRgb', [$this, 'getRgb']),
            new TwigFunction('getCssGradient', [$this, 'getCssGradient']),
        ];
    }

    /**
     * Darken this color
     */
    public function darken($hex = '#000000', int $amount = 0): string
    {
        $this->initialize($hex);
        return $this->_color->darken($amount);
    }

    /**
     * Lighten this color
     */
    public function lighten($hex = '#000000', int $amount = 0): string
    {
        $this->initialize($hex);
        return $this->_color->lighten($amount);
    }

    /**
     * Given a HEX value, returns a mixed color. If no desired amount provided, then the color
     * mixed by this ratio
     */
    public function mix($hex1, $hex2, int $amount = 0)
    {
        $this->initialize($hex1);
        return $this->_color->mix($hex2, $amount);
    }

    /**
     * Is this a dark color value?
     */
    public function isDark($hex = '#000000', int $darkerThan = 130): bool
    {
        $this->initialize($hex);
        return $this->_color->isDark($darkerThan);
    }

    /**
     * Is this a light color value?
     */
    public function isLight($hex = '#000000', int $lighterThan = 130): bool
    {
        $this->initialize($hex);
        return $this->_color->isLight($lighterThan);
    }

    /**
     * Creates an array with two shades that can be used to make a gradient
     */
    public function makeGradient($hex = '#000000', int $amount = 0): array
    {
        $this->initialize($hex);
        return $this->_color->makeGradient($amount);
    }

    /**
     * Returns the cross browser CSS3 gradient
     */
    public function getCssGradient(
        $hex,
        $amount = false,
        $vintageBrowsers = false,
        $suffix = "",
        $prefix = ""
    ): string
    {
        $this->initialize($hex);
        return $this->_color->getCssGradient($amount, $vintageBrowsers, $suffix, $prefix);
    }

    /**
     * Returns the complementary color
     */
    public function complementary($hex = '#000000'): string
    {
        $this->initialize($hex);
        return $this->_color->complementary();
    }

    /**
     * Returns your original color
     */
    public function getHex($hex = '#000000'): string
    {
        $this->initialize($hex);
        return $this->_color->getHex();
    }

    /**
     * Returns your color's HSL array
     */
    public function getHsl($hex = '#000000'): array
    {
        $this->initialize($hex);
        return $this->_color->getHsl();
    }

    /**
     * Returns your color's RGB array
     */
    public function getRgb($hex = '#000000'): array
    {
        $this->initialize($hex);
        return $this->_color->getRgb();
    }

    // Private Methods
    // =========================================================================

    /**
     * @return void
     */
    private function initialize($hex = '#000000')
    {
        if (!($this->_color && $this->_color->getHex() == str_replace('#', '', $hex))) {
            $this->_color = new Color($hex);
        }
    }
}
