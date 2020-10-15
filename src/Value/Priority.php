<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Value;

class Priority
{
    const EXPRESS = 1; // Expresní doručení do 90 minut
    const NORMAL = 2; // Doručení do 180 minut
    const ECONOMY = 3; // Doručení do 300 minut a více
}
