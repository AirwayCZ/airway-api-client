<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Environment;

class Sandbox extends AbstractEnvironment
{
    protected $baseUrl = 'http://airway.cz:6080/api.partner.v1';
}
