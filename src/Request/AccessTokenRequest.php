<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Environment;
use Airway\Partner\Client\Request;

class AccessTokenRequest implements Request
{
    /** @var Environment */
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return '/authorization/access-token';
    }

    public function getPayload(): string
    {
        return http_build_query([
            'grant_type' => 'client_credentials',
            'client_id' => $this->environment->getClientId(),
            'client_secret' => $this->environment->getClientSecret(),
        ]);
    }
}