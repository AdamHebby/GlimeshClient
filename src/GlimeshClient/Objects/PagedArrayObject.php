<?php

namespace GlimeshClient\Objects;

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
