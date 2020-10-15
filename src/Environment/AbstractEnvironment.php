<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Environment;

use Airway\Partner\Client\Environment;

abstract class AbstractEnvironment implements Environment
{
    /** @var string */
    protected $baseUrl;
    /** @var string */
    protected $clientId;
    /** @var string */
    protected $clientSecret;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}