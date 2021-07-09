<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Helper;

use Airway\Partner\Client\Value\VehicleType;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class VehicleTypeHelperTest extends TestCase
{
    /**
     * @dataProvider provideTestData
     */
    public function testTypeFromPackage(int $expectedType, float $weight, float $width, float $height, float $length): void
    {
        Assert::assertEquals(
            $expectedType,
            (new VehicleTypeHelper())->typeFromPackage($weight, $width, $height, $length)
        );
    }

    public function provideTestData(): array
    {
        return [
            [VehicleType::SINGLE_TRACK, 2, 100, 100, 50],
            [VehicleType::SINGLE_TRACK, 2, 100, 50, 100],
        ];
    }
}
