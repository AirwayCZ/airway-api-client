<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ActiveParcelListRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $response = $this->client->send(new ActiveParcelListRequest());
        Assert::assertTrue($response->isOk());
        Assert::assertIsArray($response->getData());
        foreach ($response->getData() as $item) {
            Assert::assertArrayHasKey('parcelId', $item);
            Assert::assertArrayHasKey('externalId', $item);
            Assert::assertArrayHasKey('slotId', $item);
        }
    }
}
