<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

interface TokenStorage
{
    public function getExpiresIn(): \DateTimeInterface;

    public function getAccessToken(): string;

    public function isValid(): bool;

    public function store(array $data): void;
}