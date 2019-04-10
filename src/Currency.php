<?php

declare(strict_types=1);

namespace Assimtech\Fiat;

use Symfony\Component\Intl\Intl;

class Currency
{
    /**
     * @var string $code ISO 4217 alpha3 currency code
     */
    private $code;

    private $fractionDigits;

    /**
     * @param string $code ISO 4217 alpha3 currency code
     */
    public function __construct(
        string $code
    ) {
        $this->code = $code;
        $this->fractionDigits = Intl::getCurrencyBundle()->getFractionDigits($code);
    }

    public function __toString(): string
    {
        return $this->code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getFractionDigits(): int
    {
        return $this->fractionDigits;
    }
}
