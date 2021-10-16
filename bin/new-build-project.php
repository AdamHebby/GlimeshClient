<?php

use GlimeshClient\Builder\Builder;

require_once __DIR__ . '/../vendor/autoload.php';


$builder = new Builder(__DIR__ . '/../etc/api.json');

$builder->build();
