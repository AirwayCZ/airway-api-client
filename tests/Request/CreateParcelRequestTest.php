<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Value\PaymentType;
use Airway\Partner\Client\Value\VehicleType;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CreateParcelRequestTest extends TestCase
{

    use CommonSetupTrait;

    public function testSendRequest(): void
    {
        $refNum = bin2hex(random_bytes(8));
        $request = new CreateParcelRequest([
            "externalId" => $refNum,
            "referenceNumber" => $refNum,
            "vehicleType" => VehicleType::CAR,
            "paymentType" => PaymentType::MONTHLY_BILL,
            "pickupContact" => "Jan Novak",
            "pickupPhone" => "+420 601 330 241",
            "pickupAddress" => [
                "address" => "Zubrnicka 1",
                "city" => "Praha",
                "postcode" => "",
                "countryCode" => "CZ",
            ],
            "deliveryContact" => "John Doe",
            "deliveryPhone" => "+420 601 330241",
            "deliveryAddress" => [
                "address" => "Za strasnickou vozovnou 6",
                "city" => "Praha",
                "postcode" => "10000",
                "countryCode" => "CZ",
            ],
            "earliestPickupTime" => (new \DateTime('next weekday 08:00'))->format('c'),
            "deliveryDeadline" => (new \DateTime('next weekday 12:00'))->format('c'),
            "hasCashOnDelivery" => false,
            "sizeX" => 1200,
            "sizeY" => 300,
            "sizeZ" => 200,
            "weight" => 3.1,
            "amountOfPackages" => 1,
        ]);

        $response = $this->client->send($request);

        Assert::assertTrue($response->isOk());
        Assert::assertTrue($response->getPayload()['ok']);
        Assert::assertArrayHasKey('parcelId', $response->getData());
    }
}
