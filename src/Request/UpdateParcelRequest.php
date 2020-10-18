<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Request;

class UpdateParcelRequest implements Request
{
    private $payload = [];
    /** @var string */
    private $parcelId;

    public function __construct(string $parcelId, array $input)
    {
        $this->parcelId = $parcelId;
        $this->payload = $input;
    }

    public function getUrl(): string
    {
        return '/parcel/update/' . $this->parcelId;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return json_encode($this->payload);
    }

}