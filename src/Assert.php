<?php
declare(strict_types=1);

namespace Airway\Partner\Client;

use Airway\Partner\Client\Exception\InvalidInputException;

class Assert
{
    public static function allKeysAreRequired(array $input, array $required): void
    {
        foreach ($required as $key) {
            if(!array_key_exists($key, $input)) {
                throw new InvalidInputException(
                    "Key `{$key}` is missing in request input."
                );
            }
        }
    }

    public static function validAddress(array $input)
    {
        $required = [
            "address",
            "city",
            "postcode",
            "countryCode",
        ];
        self::allKeysAreRequired($input, $required);
    }
}