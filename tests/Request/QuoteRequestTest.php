<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Client;
use Airway\Partner\Client\Fixture\EnvironmentFactory;
use Airway\Partner\Client\HttpResponse;
use Airway\Partner\Client\Value\VehicleType;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class QuoteRequestTest extends TestCase
{
    /** @var Client */
    private $client;

    protected function setUp()
    {
        $this->client = new Client(EnvironmentFactory::create());
    }

    public function testSendRequest()
    {
        $request = new QuoteRequest([
            "vehicleType" => VehicleType::CAR,
            "pickupAddress" => [
                "address" => "Zubrnicka 1",
                "city" => "Praha",
                "postcode" => "19000",
                "countryCode" => "CZ",
            ],
            "deliveryAddress" => [
                "address" => "Za strasnickou vozovnou 6",
                "city" => "Praha",
                "postcode" => "10000",
                "countryCode" => "CZ",
            ],
            "earliestPickupTime" => (new \DateTime('next weekday 08:00'))->format('c'),
            "deliveryDeadline" => (new \DateTime('next weekday 12:00'))->format('c'),
            "hasCashOnDelivery" => false,
        ]);
        $response = $this->client->send($request);
        Assert::assertInstanceOf(HttpResponse::class, $response);
        Assert::assertTrue($response->isOk());
        Assert::assertTrue($response->getJson()['ok']);
    }
}
