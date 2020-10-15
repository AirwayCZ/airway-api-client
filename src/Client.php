<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

use Airway\Partner\Client\Exception\AuthorizationException;
use Airway\Partner\Client\Exception\ServiceException;
use Airway\Partner\Client\Request\AccessTokenRequest;
use Airway\Partner\Client\TokenStorage\FileTokenStorage;

class Client
{
    /** @var Environment */
    private $environment;
    /** @var TokenStorage */
    private $storage;

    public function __construct(
        Environment $environment,
        TokenStorage $storage = null
    )
    {
        $this->environment = $environment;
        $this->storage = $storage ?: new FileTokenStorage();
    }

    public function send(Request $request)
    {
        if(!$this->storage->isValid()) {
            $this->authorize();
        }
        $response = $this->sendRequest($request);
        if($response->isOk()) {
            return $response;
        }
        $this->authorize();
        $response = $this->sendRequest($request);
        if($response->isOk()) {
            return $response;
        }
        throw new ServiceException(json_encode($response->getJson()));
    }

    private function getAccessToken(): string
    {
        if($this->storage->isValid()) {
            return $this->storage->getAccessToken();
        }
        $this->authorize();
        return $this->storage->getAccessToken();
    }

    public function authorize(): void
    {
        $accessToken = new AccessTokenRequest($this->environment);
        $opts = ['http' =>
            [
                'ignore_errors' => true,
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $accessToken->getPayload(),
            ]
        ];
        $context  = stream_context_create($opts);
        $response = new HttpResponse(
            @file_get_contents($this->environment->getBaseUrl() . $accessToken->getUrl(), false, $context) ?: '{}',
            $http_response_header
        );
        if($response->isOk()) {
            $this->storage->store($response->getJson());
            return;
        }
        throw new AuthorizationException("Invalid authorization");
    }

    private function sendRequest(Request $request): HttpResponse
    {
        $opts = ['http' =>
            [
                'ignore_errors' => true,
                'method' => $request->getMethod(),
                'header' => "Content-Type: application/json\r\n" .
                    "Authorization: Bearer {$this->getAccessToken()}\r\n",
                'content' => $request->getPayload(),
            ]
        ];
        $context = stream_context_create($opts);
        $response = new HttpResponse(
            @file_get_contents($this->environment->getBaseUrl() . $request->getUrl(), false, $context) ?: '{}',
            $http_response_header
        );
        return $response;
    }
}