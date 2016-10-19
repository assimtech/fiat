<?php

namespace Assimtech\Fiat\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use Assimtech\Fiat;

class Accountant extends Twig_Extension
{
    /**
     * @var Fiat\Accountant $accountant
     */
    protected $accountant;

    /**
     * @param Fiat\Accountant $accountant
     */
    public function __construct(Fiat\Accountant $accountant)
    {
        $this->accountant = $accountant;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('add_money', array($this, 'add')),
            new Twig_SimpleFunction('subtract_money', array($this, 'subtract')),
            new Twig_SimpleFunction('multiply_money', array($this, 'multiply')),
            new Twig_SimpleFunction('divide_money', array($this, 'divide')),
            new Twig_SimpleFunction('sum_monies', array($this, 'sum')),
        );
    }

    /**
     * $money1 + $money2
     *
     * @param Fiat\Money $money1
     * @param Fiat\Money $money2
     * @return Fiat\Money
     */
    public function add(Fiat\Money $money1, Fiat\Money $money2)
    {
        return $this->accountant->add($money1, $money2);
    }

    /**
     * $money1 - $money2
     *
     * @param Fiat\Money $money1
     * @param Fiat\Money $money2
     * @return Fiat\Money
     */
    public function subtract(Fiat\Money $money1, Fiat\Money $money2)
    {
        return $this->accountant->subtract($money1, $money2);
    }

    /**
     * $money * $fraction
     *
     * @param Fiat\Money $money
     * @param float|integer $fraction
     * @return Fiat\Money
     */
    public function multiply(Fiat\Money $money, $fraction)
    {
        return $this->accountant->multiply($money, $fraction);
    }

    /**
     * $money / $fraction
     *
     * @param Fiat\Money $money
     * @param float|integer $fraction
     * @return Fiat\Money
     */
    public function divide(Fiat\Money $money, $fraction)
    {
        return $this->accountant->divide($money, $fraction);
    }

    /**
     * @param Fiat\Money[] $monies
     * @return Fiat\Money
     */
    public function sum(array $monies)
    {
        return $this->accountant->sum($monies);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'assimtech_fiat_accountant';
    }
}
