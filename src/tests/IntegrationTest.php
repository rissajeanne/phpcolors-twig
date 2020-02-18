<?php
use rissajeanne\phpcolorstwig\twigextensions\PHPColorsTwigExtension;
use Twig\Test\IntegrationTestCase;

class PHPColorsExtension_Tests_IntegrationTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        return [
            new PHPColorsTwigExtension(),
        ];
    }

    public function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}
