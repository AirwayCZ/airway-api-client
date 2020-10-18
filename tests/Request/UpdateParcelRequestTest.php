<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UpdateParcelRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $parcelResponse = $this->createParcel();
        $request = new UpdateParcelRequest(
            $parcelResponse->getData()['parcelId'],
            [
                "externalId" => bin2hex(random_bytes(12)),
            ]
        );
        $response = $this->client->send($request);
        Assert::assertTrue($response->isOk());
        Assert::assertArrayHasKey('parcelId', $response->getData());
    }
}
