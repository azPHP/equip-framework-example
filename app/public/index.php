<?php
require __DIR__ . '/../vendor/autoload.php';

use Example\ActionWelcome;
use Example\User\ActionListUsers;
use Example\User\ActionGetUser;
use Example\User\ActionCreateUser;
use Example\User\ActionDeleteUser;

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
            return $directory->get('/', ActionWelcome::class)
                    ->get('/users/', ActionListUsers::class)
                    ->get('/users/{username}', ActionGetUser::class)
                    ->post('/users', ActionCreateUser::class)
                    ->delete('/users/{username}', ActionDeleteUser::class);
        }
    ])
    ->run();
