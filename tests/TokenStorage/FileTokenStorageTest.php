<?php
declare(strict_types=1);

namespace Airway\Partner\Client\TokenStorage;

use Airway\Partner\Client\Exception\StorageException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class FileTokenStorageTest extends TestCase
{
    private static $response = [];

    public static function setUpBeforeClass()
    {
        self::$response = [
            "token_type" => "Bearer",
            "expires_in" => 10800,
            "access_token" => bin2hex(random_bytes(24)),
        ];
    }
    
    public function test__construct(): void
    {
        $storage = new FileTokenStorage();
        Assert::assertInstanceOf(FileTokenStorage::class, $storage);
    }

    public function testAccessDataWithoutStorage()
    {
        $this->expectException(StorageException::class);
        $storage = new FileTokenStorage($this->getRandomPath());
        $storage->getAccessToken();
    }

    public function testStorage(): void
    {
        $storage = new FileTokenStorage($this->getRandomPath());
        $storage->store(self::$response);
        Assert::assertEquals(
            self::$response['access_token'],
            $storage->getAccessToken()
        );
    }

    public function testGetExpiresIn(): void
    {
        $storage = new FileTokenStorage();
        $storage->store(self::$response);
        Assert::assertInstanceOf(\DateTimeInterface::class, $storage->getExpiresIn());
    }

    public function testIsValid(): void
    {
        $storage = new FileTokenStorage();
        $storage->store(self::$response);
        Assert::assertTrue($storage->isValid());
    }

    private function getRandomPath(): string
    {
        return __DIR__ . '/../../storage/' . bin2hex(random_bytes(12)) . '.json';
    }
}
