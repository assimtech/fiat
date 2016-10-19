<?php

namespace spec\Assimtech\Fiat;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Assimtech\Fiat\Money;
use Assimtech\Fiat\Currency;
use InvalidArgumentException;

class AccountantSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Assimtech\Fiat\Accountant');
    }

    function it_cant_missmatch_currencies(Money $money1, Money $money2)
    {
        $currency1 = new Currency('USD');
        $currency2 = new Currency('JPY');

        $money1->getAmount()->willReturn(1);
        $money1->__toString()->willReturn('1.00 USD');
        $money1->getCurrency()->willReturn($currency1);

        $money2->getAmount()->willReturn(2);
        $money2->__toString()->willReturn('2 JPY');
        $money2->getCurrency()->willReturn($currency2);

        $this
            ->shouldThrow(new InvalidArgumentException(
                'Cannot work with monies of differing currencies (1.00 USD, 2 JPY)'
            ))
            ->during('add', array(
                $money1,
                $money2
            ))
        ;
    }

    function it_can_add(Money $money1, Money $money2)
    {
        $currency = new Currency('USD');

        $money1->getAmount()->willReturn(1);
        $money1->getCurrency()->willReturn($currency);

        $money2->getAmount()->willReturn(2);
        $money2->getCurrency()->willReturn($currency);

        $this->add($money1, $money2)->shouldBeLike(new Money(3, $currency));
    }

    function it_can_subtract(Money $money1, Money $money2)
    {
        $currency = new Currency('USD');

        $money1->getAmount()->willReturn(1);
        $money1->getCurrency()->willReturn($currency);

        $money2->getAmount()->willReturn(2);
        $money2->getCurrency()->willReturn($currency);

        $this->subtract($money1, $money2)->shouldBeLike(new Money(-1, $currency));
    }

    function it_can_multiply(Money $money)
    {
        $currency = new Currency('USD');

        $money->getAmount()->willReturn(1);
        $money->getCurrency()->willReturn($currency);

        $fraction = 2.5;

        $this->multiply($money, $fraction)->shouldBeLike(new Money(2.5, $currency));
    }

    function it_can_divide(Money $money)
    {
        $currency = new Currency('USD');

        $money->getAmount()->willReturn(1);
        $money->getCurrency()->willReturn($currency);

        $fraction = 3;

        $this->divide($money, $fraction)->shouldBeLike(new Money(0.33, $currency));
    }

    function it_can_sum(Money $money1, Money $money2, Money $money3)
    {
        $currency = new Currency('USD');

        $money1->getAmount()->willReturn(1);
        $money1->getCurrency()->willReturn($currency);

        $money2->getAmount()->willReturn(2);
        $money2->getCurrency()->willReturn($currency);

        $money3->getAmount()->willReturn(3);
        $money3->getCurrency()->willReturn($currency);

        $this->sum(array(
            $money1,
            $money2,
            $money3,
        ))->shouldBeLike(new Money(6, $currency));
    }

    function it_cant_sum_non_money()
    {
        $this
            ->shouldThrow(new InvalidArgumentException(
                '$monies must be an array of Money'
            ))
            ->during('sum', array(
                array(
                    1,
                ),
            ))
        ;
    }
}
