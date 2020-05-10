<?php

use kosuha606\VirtualModelHelppack\ServiceManager;
use kosuha606\VirtualModelHelppack\Test\TestService;

require_once __DIR__.'/../vendor/autoload.php';

try {
    ServiceManager::getInstance()->setDefinitions(
        [
            TestService::class => TestService::getInstance()->setFromWhere('definitions'),
        ]
    );
} catch (Exception $e) {
}