<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Request;


use Airway\Partner\Client\Assert;
use Airway\Partner\Client\Exception\InvalidInputException;
use Airway\Partner\Client\Request;

class SimulateCallbackRequest implements Request
{
    private $payload = [];

    public function __construct(array $input)
    {
        $this->validateInput($input);
        $this->payload = $input;
    }

    public function getUrl(): string
    {
        return '/parcel/simulate-callback';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPayload(): string
    {
        return json_encode($this->payload);
    }

    /**
     * @param array $input
     * @throws InvalidInputException
     */
    private function validateInput(array $input): void
    {
        $required = [
            "parcelId",
            "status",
        ];
        Assert::allKeysAreRequired($input, $required);
    }

}