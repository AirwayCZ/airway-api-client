<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

use Airway\Partner\Client\Environment\Sandbox;
use Airway\Partner\Client\Exception\AuthorizationException;
use Airway\Partner\Client\Exception\ServiceException;
use Airway\Partner\Client\Fixture\EnvironmentFactory;
use Airway\Partner\Client\Request\QuoteRequest;
use Airway\Partner\Client\TokenStorage\FileTokenStorage;
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
        $quote = QuoteRequest::create([
            'vehicleType' => VehicleType::CAR,
        ]);
        $client = new Client($this->environment);
        $response = $client->send($quote);
        Assert::assertInstanceOf(HttpResponse::class, $response);
    }

    public function testSend_WithInvalidEnvironment(): void
    {
        $this->expectException(AuthorizationException::class);
        $quote = QuoteRequest::create([
            'vehicleType' => VehicleType::CAR,
        ]);
        $client = new Client(
            new Sandbox('a', 'b'),
            new FileTokenStorage(__DIR__ . '/../storage/' . bin2hex(random_bytes(12)) . '.json')
        );
        $client->send($quote);
    }
}
