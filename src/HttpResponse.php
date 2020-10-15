<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

class HttpResponse
{
    private $json = [];
    private $headers = [];
    private $isOk = false;

    public function __construct(
        string $jsonString,
        array $headers
    )
    {
        $this->json = \json_decode($jsonString, true) ?: [];
        foreach ($headers as $header) {
            if ($header == 'HTTP/1.1 200 OK') {
                $this->isOk = true;
                continue;
            }
            $strpos = strpos($header, ': ');
            if ($strpos != 0) {
                $this->headers[substr($header, 0, $strpos)] = substr($header, $strpos + 2);
            }
        }
    }

    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function getJson(): array
    {
        return $this->json;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}