<?php

namespace GlimeshClient\Tests;

use GlimeshClient\Builder\Builder;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Builder class, from start to finish, rather complex
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient_Tests
 */
class BuilderTest extends TestCase
{
    public const DIR = '/tmp/BuilderTest';
    public const API_JSON = __DIR__ . '/../../../bin/Builder/resources/api.json';

    public function testConstruct()
    {
        $builder = new Builder(self::API_JSON);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function setUp(): void
    {
        mkdir(static::DIR);
    }

    protected function tearDown(): void
    {
        // yoink https://stackoverflow.com/questions/7288029/php-delete-directory-that-is-not-empty
        $it = new \RecursiveDirectoryIterator(static::DIR, \FilesystemIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach($it as $file) {
            if ($file->isDir()) rmdir($file->getPathname());
            else unlink($file->getPathname());
        }
        rmdir(static::DIR);
    }

    public function testBuildFull()
    {
        $builder = new Builder(__DIR__ . '/../../../etc/api.json');

        $builder->paths = [
            'INTERFACE'     => '/tmp/BuilderTest',
            'OBJECT'        => '/tmp/BuilderTest',
            'INPUT_OBJECT'  => '/tmp/BuilderTest',
            'ENUM'          => '/tmp/BuilderTest',
        ];

        $builder->build();
        $paths = [];

        $it = new \RecursiveDirectoryIterator(static::DIR, \FilesystemIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($it as $file) {
            if (!$file->isDir()) $paths[] = $file->getPathname();
        }

        sort($paths);

        $this->assertEquals([
            static::DIR . '/Category.php',
            static::DIR . '/Channel.php',
            static::DIR . '/ChannelBan.php',
            static::DIR . '/ChannelModerationLog.php',
            static::DIR . '/ChannelModerator.php',
            static::DIR . '/ChannelStatus.php',
            static::DIR . '/ChatMessage.php',
            static::DIR . '/ChatMessageInput.php',
            static::DIR . '/ChatMessageToken.php',
            static::DIR . '/ChatMessageToken/EmoteToken.php',
            static::DIR . '/ChatMessageToken/TextToken.php',
            static::DIR . '/ChatMessageToken/UrlToken.php',
            static::DIR . '/Follower.php',
            static::DIR . '/Stream.php',
            static::DIR . '/StreamMetadata.php',
            static::DIR . '/StreamMetadataInput.php',
            static::DIR . '/Sub.php',
            static::DIR . '/Subcategory.php',
            static::DIR . '/Tag.php',
            static::DIR . '/User.php',
            static::DIR . '/UserSocial.php',
        ], array_values($paths));
    }
}
