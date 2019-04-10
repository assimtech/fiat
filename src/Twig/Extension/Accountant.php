<?php

declare(strict_types=1);

namespace Assimtech\Fiat\Twig\Extension;

use Assimtech\Fiat;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Accountant extends AbstractExtension
{
    protected $accountant;

    public function __construct(
        Fiat\Accountant $accountant
    ) {
        $this->accountant = $accountant;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('add_money', [$this, 'add']),
            new TwigFunction('subtract_money', [$this, 'subtract']),
            new TwigFunction('multiply_money', [$this, 'multiply']),
            new TwigFunction('divide_money', [$this, 'divide']),
            new TwigFunction('sum_monies', [$this, 'sum']),
        ];
    }

    /**
     * $money1 + $money2
     */
    public function add(
        Fiat\Money $money1,
        Fiat\Money $money2
    ): Fiat\Money {
        return $this->accountant->add($money1, $money2);
    }

    /**
     * $money1 - $money2
     */
    public function subtract(
        Fiat\Money $money1,
        Fiat\Money $money2
    ): Fiat\Money {
        return $this->accountant->subtract($money1, $money2);
    }

    /**
     * $money * $fraction
     *
     * @param float|integer $fraction
     */
    public function multiply(
        Fiat\Money $money,
        $fraction
    ): Fiat\Money {
        return $this->accountant->multiply($money, $fraction);
    }

    /**
     * $money / $fraction
     *
     * @param float|integer $fraction
     */
    public function divide(
        Fiat\Money $money,
        $fraction
    ): Fiat\Money {
        return $this->accountant->divide($money, $fraction);
    }

    /**
     * @param Fiat\Money[] $monies
     */
    public function sum(
        array $monies
    ): ?Fiat\Money {
        return $this->accountant->sum($monies);
    }

    public function getName(): string
    {
        return 'assimtech_fiat_accountant';
    }
}
