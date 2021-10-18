<?php

namespace GlimeshClient\Tests\Enums;

use GlimeshClient\Objects\Enums\ChannelStatus;
use PHPUnit\Framework\TestCase;

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
