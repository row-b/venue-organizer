<?php
namespace CoreDomain\Assert;

use Assert\Assertion as BaseAssertion;

class Assertion extends BaseAssertion
{
    protected static $exceptionClass = 'CoreDomain\Exception\InvalidArgumentValidationException';
}