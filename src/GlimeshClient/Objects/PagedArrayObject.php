<?php

namespace GlimeshClient\Objects;

/**
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class PagedArrayObject extends \ArrayObject
{
    public function __construct(
        array $array,
        public PageInfo $pageInfo,
        public int $edgeCount
    ) {
        parent::__construct($array);
    }
}
