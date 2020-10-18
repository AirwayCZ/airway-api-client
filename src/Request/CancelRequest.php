<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;


use Airway\Partner\Client\Request;

class CancelRequest implements Request
{
    /** @var string */
    private $parcelId;

    public function __construct(string $parcelId)
    {
        $this->parcelId = $parcelId;
    }

    public function getUrl(): string
    {
        return '/parcel/cancel/' . $this->parcelId;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return '';
    }

}