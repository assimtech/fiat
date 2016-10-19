<?php

namespace Assimtech\Fiat;

use Symfony\Component\Intl\Intl;

class Currency
{
    /**
     * @var string $code ISO 4217 alpha3 currency code
     */
    private $code;

    /**
     * @var integer $fractionDigits
     */
    private $fractionDigits;

    /**
     * @param string $code ISO 4217 alpha3 currency code
     */
    public function __construct($code)
    {
        $this->code = $code;
        $this->fractionDigits = Intl::getCurrencyBundle()->getFractionDigits($code);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return integer
     */
    public function getFractionDigits()
    {
        return $this->fractionDigits;
    }
}
