<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

interface Request
{
    public function getUrl(): string;
    public function getMethod(): string;
    public function getPayload(): string;
}
