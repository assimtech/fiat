<?php

declare(strict_types=1);

namespace Assimtech\Fiat;

use InvalidArgumentException;

class Accountant
{
    /**
     * @throws InvalidArgumentException
     */
    protected function checkCurrenciesMatch(
        Money $money1,
        Money $money2
    ): void {
        if ($money1->getCurrency()->getCode() !== $money2->getCurrency()->getCode()) {
            throw new InvalidArgumentException(sprintf(
                'Cannot work with monies of differing currencies (%s, %s)',
                $money1,
                $money2
            ));
        }
    }

    /**
     * $money1 + $money2
     */
    public function add(
        Money $money1,
        Money $money2
    ): Money {
        $this->checkCurrenciesMatch($money1, $money2);

        return new Money(
            $money1->getAmount() + $money2->getAmount(),
            $money1->getCurrency()
        );
    }

    /**
     * $money1 - $money2
     */
    public function subtract(
        Money $money1,
        Money $money2
    ): Money {
        $this->checkCurrenciesMatch($money1, $money2);

        return new Money(
            $money1->getAmount() - $money2->getAmount(),
            $money1->getCurrency()
        );
    }

    /**
     * $money * $fraction
     *
     * @param float|integer $fraction
     */
    public function multiply(
        Money $money,
        $fraction
    ): Money {
        return new Money(
            $money->getAmount() * $fraction,
            $money->getCurrency()
        );
    }

    /**
     * $money / $fraction
     *
     * @param float|integer $fraction
     */
    public function divide(
        Money $money,
        $fraction
    ): Money {
        return new Money(
            $money->getAmount() / $fraction,
            $money->getCurrency()
        );
    }

    /**
     * @param array<Money> $monies
     */
    public function sum(
        array $monies
    ): ?Money {
        $totalMoney = null;

        foreach ($monies as $money) {
            if (!$money instanceof Money) {
                throw new InvalidArgumentException('$monies must be an array of Money');
            }

            if ($totalMoney === null) {
                $totalMoney = clone $money;

                continue;
            }

            $totalMoney = $this->add($totalMoney, $money);
        }

        return $totalMoney;
    }
}
