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
            new TwigFunction('isDark', [$this, 'getIsDark']),
        ];
    }

    /**
     * Is this a dark color value?
     */
    public function getIsDark(string $hex = '#000000'): bool
    {
        $color = new Color($hex);
        return $color->isDark();
    }
}
