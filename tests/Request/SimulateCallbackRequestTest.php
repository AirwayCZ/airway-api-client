<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Value\ParcelStatus;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SimulateCallbackRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $parcelResponse = $this->createParcel();
        $response = $this->client->send(new SimulateCallbackRequest([
            'parcelId' => $parcelResponse->getData()['parcelId'],
            'status' => ParcelStatus::AT_DELIVERY,
        ]));
        Assert::assertTrue($response->isOk());
    }
}
