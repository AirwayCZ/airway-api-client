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
            }
            $strpos = strpos($header, ': ');
            if ($strpos !== false) {
                $this->headers[substr($header, 0, $strpos)] = substr($header, $strpos + 2);
            } else {
                $this->headers['Status'] = $header;
            }
        }
    }

    public function isOk(): bool
    {
        return $this->isOk && isset($this->json['ok']) && $this->json['ok'];
    }

    public function getPayload(): array
    {
        return $this->json;
    }

    public function getData(): array
    {
        if(isset($this->json['data'])) {
            return $this->json['data'];
        }
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}