<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Value;

class PaymentType
{
    const ONLINE = 100; // Předem online
    const MONTHLY_BILL = 200; // V rámci měsíčního vyúčtování
    const ON_SPOT_SENDER = 300; // Na místě odesilatelem
    const ON_SPOT_RECIPIENT = 400; // Na místě příjemcem
}