# Fiat

[![Build Status](https://travis-ci.org/assimtech/fiat.svg?branch=master)](https://travis-ci.org/assimtech/fiat)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/assimtech/fiat/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/assimtech/fiat/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/assimtech/fiat/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/assimtech/fiat/?branch=master)

Provides models for representing Money, Currency and an Accountant performing arithmetic on Money without causing rounding errors



## The Models

### Currency

```php
$usd = new Assimtech\Fiat\Currency('USD');
echo (string)$usd; // Outputs USD
echo $usd->getFractionDigits(); // Outputs 2

$jpy = new Assimtech\Fiat\Currency('JPY');
echo $jpy->getFractionDigits(); // Outputs 0

$iqd = new Assimtech\Fiat\Currency('IQD');
echo $iqd->getFractionDigits(); // Outputs 3
```


### Money

```php
// assuming Locale is en-US
$money = new Assimtech\Fiat\Money(pi(), $usd);
echo (string)$money; // Outputs 3.14 USD
echo $money->getFormattedAmount(); // Outputs 3.14
echo $money->getFormattedAmount('de-DE'); // Outputs 3,14
```


## The Accountant

```php
$accountant = new Assimtech\Fiat\Accountant();

$threeUSD = $accountant->add($oneUSD, $twoUSD);

$sixUSD = $accountant->subtract($tenUSD, $fourUSD);

$eightUSD = $accountant->multiply($fourUSD, 2);

$threeUSD = $accountant->divide($nineUSD, 3);

$sixUSD = $accountant->sum([
    $oneUSD,
    $twoUSD,
    $threeUSD,
]);
```


## Twig extension

The accountant is also exposed as a Twig extension

```twig
{{ add_money(money1, money2) }}

{{ subtract_money(money1, money2) }}

{{ multiply_money(money, fraction) }}

{{ divide_money(money, fraction) }}

{{ sum_money([ money1, money2, money3 ]) }}
```


## Frameworks

Please see [FiatBundle](https://github.com/assimtech/fiat-bundle) for integration with Symfony 4
