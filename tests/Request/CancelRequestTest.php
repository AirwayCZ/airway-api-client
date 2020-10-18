<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CancelRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $createResponse = $this->createParcel();
        $response = $this->client->send(new CancelRequest($createResponse->getData()['parcelId']));
        Assert::assertTrue($response->isOk());
        Assert::assertArrayHasKey('externalId', $response->getData());
    }

}
