<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Helper;

use Airway\Partner\Client\Value\VehicleType;

class VehicleTypeHelper
{
    const MAX_VALUES = [
        // kg, x, y, z
        VehicleType::SINGLE_TRACK => [3, 300, 200, 50],
        VehicleType::CAR => [30, 600, 400, 200],
        VehicleType::VAN_SMALL => [300, 1200, 800, 600],
        VehicleType::VAN_LARGE => [1200, 3500, 1800, 1400],
    ];

    public function typeFromPackage(float $weight, float $width, float $height, float $length): int
    {
        $cube = [$width, $height, $length];
        rsort($cube);

        foreach (self::MAX_VALUES as $key=>$max) {
            $maxCube = array_slice($max, 1);
            if($weight <= $max[0] && $this->maxCubeContains($maxCube, $cube)) {
                return $key;
            }
        }
        return VehicleType::VAN_LARGE;
    }

    /**
     * @param array $maxCube
     * @param array $cube
     * @return bool
     */
    protected function maxCubeContains(array $maxCube, array $cube): bool
    {
        return $maxCube[0] >= $cube[0]
            && $maxCube[1] >= $cube[1]
            && $maxCube[2] >= $cube[2];
    }
}