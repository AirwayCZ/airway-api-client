<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;


use Airway\Partner\Client\Request;

class ActiveParcelListRequest implements Request
{
    public function getUrl(): string
    {
        return '/parcel/active';
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getPayload(): string
    {
        return '';
    }

}