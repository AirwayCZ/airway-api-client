<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;


use Airway\Partner\Client\Request;

class StatusOfParcelListRequest implements Request
{
    private $parcelIdList;

    public function __construct(array $parcelIdList)
    {
        $this->parcelIdList = $parcelIdList;
    }

    public function getUrl(): string
    {
        return '/parcel/statuses';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return json_encode(['parcelIdList' => $this->parcelIdList]);
    }

}