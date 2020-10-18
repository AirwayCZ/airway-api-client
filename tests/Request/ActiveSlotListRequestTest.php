<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ActiveSlotListRequestTest extends TestCase
{
    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $this->createParcel('2020 01');
        $response = $this->client->send(new ActiveSlotListRequest());
        Assert::assertTrue($response->isOk());
    }
}
