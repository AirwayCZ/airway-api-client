<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Request;
use Webmozart\Assert\Assert;

class ConfirmParcelByParcelIdListRequest implements Request
{
    /**
     * @var array
     */
    private $parcelIdList;

    public function __construct(
        array $parcelIdList
    )
    {
        $this->parcelIdList = $parcelIdList;
    }

    public function getUrl(): string
    {
        return '/parcel/confirm-by-parcel-id-list';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return json_encode($this->parcelIdList);
    }

}