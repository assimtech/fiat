<?php

namespace Assimtech\Fiat;

use InvalidArgumentException;

class Accountant
{
    /**
     * @param Money $money1
     * @param Money $money2
     * @throws InvalidArgumentException
     */
    protected function checkCurrenciesMatch(Money $money1, Money $money2)
    {
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
     *
     * @param Money $money1
     * @param Money $money2
     * @return Money
     */
    public function add(Money $money1, Money $money2)
    {
        $this->checkCurrenciesMatch($money1, $money2);

        return new Money(
            $money1->getAmount() + $money2->getAmount(),
            $money1->getCurrency()
        );
    }

    /**
     * $money1 - $money2
     *
     * @param Money $money1
     * @param Money $money2
     * @return Money
     */
    public function subtract(Money $money1, Money $money2)
    {
        $this->checkCurrenciesMatch($money1, $money2);

        return new Money(
            $money1->getAmount() - $money2->getAmount(),
            $money1->getCurrency()
        );
    }

    /**
     * $money * $fraction
     *
     * @param Money $money
     * @param float|integer $fraction
     * @return Money
     */
    public function multiply(Money $money, $fraction)
    {
        return new Money(
            $money->getAmount() * $fraction,
            $money->getCurrency()
        );
    }

    /**
     * $money / $fraction
     *
     * @param Money $money
     * @param float|integer $fraction
     * @return Money
     */
    public function divide(Money $money, $fraction)
    {
        return new Money(
            $money->getAmount() / $fraction,
            $money->getCurrency()
        );
    }

    /**
     * @param Money[] $monies
     * @return Money|null
     */
    public function sum(array $monies)
    {
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
