<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Request;

class ConfirmParcelBySlotRequest implements Request
{
    private $slotId;

    public function __construct(string $slotId)
    {
        $this->slotId = $slotId;
    }

    public function getUrl(): string
    {
        return '/parcel/confirm-by-slot';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return json_encode(['slotId' => $this->slotId]);
    }
}
