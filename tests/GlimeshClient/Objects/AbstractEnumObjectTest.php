<?php

namespace GlimeshClient\Tests\Enums;

use GlimeshClient\Objects\Enums\ChannelStatus;
use PHPUnit\Framework\TestCase;

/**
 * Tests the AbstractEnumObject using ChannelStatus
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient_Tests
 */
class AbstractEnumObjectTest extends TestCase
{
    public function testConstruct()
    {
        $enum = new ChannelStatus(["LIVE"]);
        $this->assertEquals($enum->currentValue, ChannelStatus::LIVE);

        $enum = new ChannelStatus(["OFFLINE"]);
        $this->assertEquals($enum->currentValue, ChannelStatus::OFFLINE);
    }
}
