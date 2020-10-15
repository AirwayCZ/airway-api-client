<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

interface Environment
{
    public function getClientId(): string;
    public function getClientSecret(): string;
    public function getBaseUrl(): string;
}