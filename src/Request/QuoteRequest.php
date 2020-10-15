<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;

use Airway\Partner\Client\Assert;
use Airway\Partner\Client\Exception\InvalidInputException;
use Airway\Partner\Client\Request;

class QuoteRequest implements Request
{

    private $payload = [];

    public function __construct(array $input)
    {
        $this->validateInput($input);
        $this->payload = array_replace_recursive($this->getExampleInput(), $input);
    }


    public function getUrl(): string
    {
        return '/parcel/quote';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return json_encode($this->payload);
    }

    private function getExampleInput(): array
    {
        $json = <<<JSON
{
  "vehicleType": 20,
  "pickupAddress": {
    "address": "Za strašnickou vozovnou 1343/6",
    "city": "Praha",
    "postcode": "10000",
    "countryCode": "CZ"
  },    
  "deliveryAddress": {
     "address": "Drahobejlova 36",
     "city": "Praha 9",
     "postcode": "19000",
     "countryCode": "CZ"
  },
  "earliestPickupTime": "2020-01-04 08:30:00",  
  "deliveryDeadline": "2020-01-04 12:00:00",
  "hasCashOnDelivery": false,  
  "sizeX": 0,
  "sizeY": 0,
  "sizeZ": 0,
  "weight": 1.0,
  "amountOfPackages": 1
}
JSON;
        return json_decode($json, true);
    }

    /**
     * @param array $input
     * @throws InvalidInputException
     */
    private function validateInput(array $input): void
    {
        $required = [
            "vehicleType",
            "pickupAddress",
            "deliveryAddress",
            "earliestPickupTime",
            "deliveryDeadline",
            "hasCashOnDelivery",
        ];
        Assert::allKeysAreRequired($input, $required);
        Assert::validAddress($input["pickupAddress"]);
        Assert::validAddress($input["deliveryAddress"]);
    }

}