<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

class CreateAndConfirmParcelRequest extends CreateParcelRequest
{
    public function getUrl(): string
    {
        return '/parcel/create-and-confirm';
    }
}