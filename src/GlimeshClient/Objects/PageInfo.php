<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * Description not provided
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class PageInfo extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * When paginating forwards, the cursor to continue.
     *
     * @var ?string
     */
    public readonly ?string $endCursor;

    /**
     * When paginating forwards, are there more items?
     *
     * @var ?bool
     */
    public readonly ?bool $hasNextPage;

    /**
     * When paginating backwards, are there more items?
     *
     * @var ?bool
     */
    public readonly ?bool $hasPreviousPage;

    /**
     * When paginating backwards, the cursor to continue.
     *
     * @var ?string
     */
    public readonly ?string $startCursor;
}
