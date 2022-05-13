<?php

namespace GlimeshClient\Builder\CodeBuilders;

abstract class AbstractBuilder
{
    /**
     * Standard DocBlock to place on every new class or interface
     *
     * @var array
     */
    public static array $standardDocBlock = [
        ' * @author Adam Hebden <adam@adamhebden.com>',
        ' * @copyright 2022 Adam Hebden',
        ' * @license GPL-3.0-or-later',
        ' * @package GlimeshClient',
    ];

    public static function templateValues(string $filename, array $replace): string
    {
        return str_replace(
            array_keys($replace),
            array_values($replace),
            file_get_contents($filename)
        );
    }
}
