<?php

declare(strict_types=1);

namespace spec\Assimtech\Fiat\Twig\Extension;

use Assimtech\Fiat\Accountant;
use Assimtech\Fiat\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccountantSpec extends ObjectBehavior
{
    function let(
        Accountant $accountant
    ): void {
        $this->beConstructedWith($accountant);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType('Assimtech\Fiat\Twig\Extension\Accountant');
    }

    function it_exposes_functions(): void
    {
        $this->getFunctions()->shouldHaveCount(5);
    }

    function it_can_add(
        Accountant $accountant,
        Money $money1,
        Money $money2,
        Money $money3
    ): void {
        $accountant->add($money1, $money2)->willReturn($money3);
        $this->add($money1, $money2)->shouldReturn($money3);
    }

    function it_can_subtract(
        Accountant $accountant,
        Money $money1,
        Money $money2,
        Money $money3
    ): void {
        $accountant->subtract($money1, $money2)->willReturn($money3);
        $this->subtract($money1, $money2)->shouldReturn($money3);
    }

    function it_can_multiply(
        Accountant $accountant,
        Money $money1,
        Money $money2
    ): void {
        $fraction = 3;
        $accountant->multiply($money1, $fraction)->willReturn($money2);
        $this->multiply($money1, $fraction)->shouldReturn($money2);
    }

    function it_can_divide(
        Accountant $accountant,
        Money $money1,
        Money $money2
    ): void {
        $fraction = 3;
        $accountant->divide($money1, $fraction)->willReturn($money2);
        $this->divide($money1, $fraction)->shouldReturn($money2);
    }

    function it_can_sum(
        Accountant $accountant,
        Money $money1,
        Money $money2,
        Money $money3,
        Money $money4
    ): void {
        $accountant->sum([
            $money1,
            $money2,
            $money3,
        ])->willReturn($money4);

        $this->sum([
            $money1,
            $money2,
            $money3,
        ])->shouldReturn($money4);
    }

    function it_is_named(): void
    {
        $this->getName()->shouldReturn('assimtech_fiat_accountant');
    }
}
