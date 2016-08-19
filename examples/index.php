<?php
require __DIR__ . '/../vendor/autoload.php';

use Example\User\ActionListUser;
use Example\User\ActionGetUser;

Equip\Application::build()
    // Auryn Configuration
    ->setConfiguration([
        Equip\Configuration\AurynConfiguration::class,
        Equip\Configuration\DiactorosConfiguration::class,
        Equip\Configuration\MonologConfiguration::class,
        Equip\Configuration\RelayConfiguration::class,
        Equip\Configuration\WhoopsConfiguration::class,
    ])
    // Relay middleware stack
    ->setMiddleware([
        Relay\Middleware\ResponseSender::class,
        Equip\Handler\ExceptionHandler::class,
        Equip\Handler\DispatchHandler::class,
        Equip\Handler\ActionHandler::class,
    ])
    // Your Routes
    ->setDispatching([
        function(Equip\Directory $directory)
        {
            return $directory->get('/user/', ActionListUser::class)
                    ->get('/user/{username}', ActionGetUser::class);
        }
    ])
    ->run();
