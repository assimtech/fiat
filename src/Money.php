<?php

declare(strict_types=1);

namespace Assimtech\Fiat;

use Locale;
use NumberFormatter;

class Money
{
    private $amount;
    private $currency;

    /**
     * @param float|integer $amount
     * @param Currency $currency iso4217 currency
     */
    public function __construct(
        $amount,
        Currency $currency
    ) {
        $this->currency = $currency;
        $this->setAmount($amount);
    }

    public function __toString(): string
    {
        return sprintf(
            '%s %s',
            $this->getFormattedAmount(),
            $this->currency
        );
    }

    /**
     * @param float|integer|string $amount
     */
    public function setAmount(
        $amount
    ): self {
        $this->amount = round($amount, $this->currency->getFractionDigits());

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param string|null $locale if null, defaults to Locale::getDefault
     */
    public function getFormattedAmount(
        string $locale = null
    ): string {
        if ($locale === null) {
            $locale = Locale::getDefault();
        }

        $numberFormatter = new NumberFormatter($locale, NumberFormatter::DECIMAL);
        $fractionDigits = $this->currency->getFractionDigits();
        $numberFormatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, $fractionDigits);
        $numberFormatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $fractionDigits);

        return $numberFormatter->format($this->amount);
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}
