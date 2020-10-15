<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Environment;

class Production extends AbstractEnvironment
{
    protected $baseUrl = 'https://www.airway.cz/api.partner.v1';
}
