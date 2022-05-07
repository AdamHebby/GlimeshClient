<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Identical\StrEndsWithRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;
use Rector\Php74\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;

return static function (RectorConfig $rectorConfig): void {
    // get parameters
    $parameters = $rectorConfig->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src'
    ]);

    // Define what rule sets will be applied
    $rectorConfig->import(LevelSetList::UP_TO_PHP_81);

    // Ignore rector rule
    $rectorConfig->skip([
        StrEndsWithRector::class,
        ClosureToArrowFunctionRector::class,
        JsonThrowOnErrorRector::class,
        ArraySpreadInsteadOfArrayMergeRector::class,
    ]);
};
