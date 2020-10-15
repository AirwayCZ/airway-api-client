<?php
declare(strict_types=1);

namespace Airway\Partner\Client\Value;

class ParcelStatus
{
    const NEW =	10; // NE	Nová zásilka, zrovna vytvořena (anebo draft)
    const QUOTE_REJECTED =	20; // ANO	Zásilka byla zamítnuta anebo vypršela doba pro její doručení (48 hodin).
    const CONFIRMED_BY_CUSTOMER =	30; // NE	Potvrzeno zákazníkem. Jde o finální stav tvorby zásilky klientem.
    const COURIER_PROPOSED =	40; // NE	Zásilka byla nabídnuta kurýrovi, zatím nebyla akceptována.
    const ACCEPTED_BY_COURIER =	50; // NE	Akceptována kurýrem, kurýr ještě není na cestě k odesílateli.
    const AT_PICKUP =	60; // NE	Kurýr je na adrese odesílatele zásilky.
    const EN_ROUTE =	70; // NE	Kurýr je na cestě k příjemci zásilky.
    const AT_DELIVERY =	80; // NE	Kurýr je na adrese příjemce zásilky.
    const TAKING_SIGNATURE =	90; // NE	Pořizování elektronického podpisu od příjemce anebo pořízení selfie.
    const CANCELED =	100; // ANO	Zásilka je zrušena.
    const DELIVERED =	110; // ANO	Zásilka je doručena.
    const PARTIALLY_DELIVERED =	120; // ANO	Zásilka byla částečně doručena. U zásilky bude uveden seznam nepřijatých položek.
    const REFUSED_BY_CONTACT =	130; // ANO	Zásilka byla odmítnuta odesilatelem či příjemcem. Například nebylo možné zaplatit dobírku.
}
