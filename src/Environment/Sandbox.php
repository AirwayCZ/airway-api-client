<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Environment;

class Sandbox extends AbstractEnvironment
{
    protected $baseUrl = 'https://sandbox.airway.cz/api.partner.v1';
}
