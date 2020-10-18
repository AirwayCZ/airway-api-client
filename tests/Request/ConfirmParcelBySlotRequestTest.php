<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ConfirmParcelBySlotRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest()
    {
        $slotId = '2020 ' . bin2hex(random_bytes(8));
        $this->createParcel($slotId);
        $response = $this->client->send(new ConfirmParcelBySlotRequest($slotId));
        Assert::assertTrue($response->isOk());
    }
}
