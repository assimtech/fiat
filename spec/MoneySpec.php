<?php

declare(strict_types=1);

namespace spec\Assimtech\Fiat;

use Assimtech\Fiat\Currency;
use Locale;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoneySpec extends ObjectBehavior
{
    function let(
        Currency $currency
    ): void {
        Locale::setDefault('en-US');

        $currency->__toString()->willReturn('USD');
        $currency->getFractionDigits()->willReturn(2);

        $this->beConstructedWith(1.234, $currency);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType('Assimtech\Fiat\Money');
    }

    function it_can_be_cast_to_string(): void
    {
        $this->__toString()->shouldReturn('1.23 USD');
    }

    function it_can_change_amount(): void
    {
        $this->setAmount(4.321)->shouldReturn($this);
        $this->getAmount()->shouldReturn(4.32);
    }

    function it_can_format_amount(): void
    {
        $this->getFormattedAmount('de-DE')->shouldReturn('1,23');
    }

    function it_exposes_currency(
        Currency $currency
    ): void {
        $this->getCurrency()->shouldReturn($currency);
    }
}
