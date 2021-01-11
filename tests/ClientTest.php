<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

use Airway\Partner\Client\Environment\Sandbox;
use Airway\Partner\Client\Exception\AuthorizationException;
use Airway\Partner\Client\Fixture\EnvironmentFactory;
use Airway\Partner\Client\Request\QuoteRequest;
use Airway\Partner\Client\TokenStorage\FileTokenStorage;
use Airway\Partner\Client\Value\PaymentType;
use Airway\Partner\Client\Value\VehicleType;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @var Environment */
    private $environment;

    protected function setUp()
    {
        $this->environment = EnvironmentFactory::create();
    }

    public function testAuthorize(): void
    {
        $client = new Client($this->environment);
        $client->authorize();
        Assert::assertTrue(true); // no exception
    }

    public function testAuthorize_ThrowsExceptionWithInvalidCredentials()
    {
        $this->expectException(AuthorizationException::class);
        $client = new Client(new Sandbox('a', 'b'));
        $client->authorize();
    }

    public function testSend(): void
    {
        $quote = $this->createQuoteRequest();
        $client = new Client($this->environment);
        $response = $client->send($quote);
        Assert::assertInstanceOf(HttpResponse::class, $response);
    }

    public function testSend_WithInvalidEnvironment(): void
    {
        $this->expectException(AuthorizationException::class);
        $quote = $this->createQuoteRequest();
        $client = new Client(
            new Sandbox('a', 'b'),
            new FileTokenStorage(__DIR__ . '/../storage/' . bin2hex(random_bytes(12)) . '.json')
        );
        $client->send($quote);
    }

    protected function createQuoteRequest(): QuoteRequest
    {
        return new QuoteRequest([
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
    }
}
