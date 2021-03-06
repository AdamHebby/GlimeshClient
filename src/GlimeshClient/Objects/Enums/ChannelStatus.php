<?php

namespace GlimeshClient\Objects\Enums;

/**
 * Current channel status
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
enum ChannelStatus: string
{
    case LIVE = "LIVE";
    case OFFLINE = "OFFLINE";
}
