<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Fixture;

use Airway\Partner\Client\Environment;

class EnvironmentFactory
{
    private static $environment;
    public static function create(): Environment
    {
        if(!isset(self::$environment)) {
            $config = parse_ini_file(__DIR__ . '/config.ini');
            self::$environment = new Environment\Sandbox($config['CLIENT_ID'], $config['CLIENT_SECRET']);
        }
        return self::$environment;
    }
}
