<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class StatusOfParcelListRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $parcelIdList = [];
        $parcelResponse = $this->createParcel();
        $parcelIdList[] = $parcelResponse->getData()['parcelId'];
        $parcelResponse = $this->createParcel();
        $parcelIdList[] = $parcelResponse->getData()['parcelId'];
        $response = $this->client->send(new StatusOfParcelListRequest($parcelIdList));
        Assert::assertTrue($response->isOk());
        Assert::assertEquals(2, count($response->getData()));
    }
}
