<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ParcelStatusRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest()
    {
        $parcelResponse = $this->createParcel();
        $response = $this->client->send(new ParcelStatusRequest($parcelResponse->getData()['parcelId']));
        Assert::assertTrue($response->isOk());
        Assert::assertArrayHasKey('status', $response->getData());
        Assert::assertArrayHasKey('externalId', $response->getData());
    }
}
