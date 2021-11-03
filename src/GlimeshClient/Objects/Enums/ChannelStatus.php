<?php

namespace GlimeshClient\Objects\Enums;

/**
 * Current channel status
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChannelStatus extends AbstractEnumObject
{
    public const POSSIBLE_VALUES = [
        "LIVE",
        "OFFLINE"
    ];
    public const LIVE = "LIVE";
    public const OFFLINE = "OFFLINE";
}
