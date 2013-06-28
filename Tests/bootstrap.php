<?php

mb_internal_encoding('UTF-8');

include __DIR__ . '/../global_functions.php';

if (!is_file($autoloadFile = __DIR__.'/../vendor/autoload.php')) {
    throw new \LogicException('Could not find autoload.php in vendor/. Did you run "composer install --dev"?');
}

require $autoloadFile;