<?php

declare(strict_types=1);

namespace Yasumi;

abstract class HolidayNew extends \DateTimeImmutable implements HolidayInterface, \JsonSerializable, \Stringable
{
    /** @var array list of translations of this holiday */
    public $translations;

    public function __construct(\DateTimeInterface $date)
    {
        parent::__construct($date->format('Y-m-d'), $date->getTimezone());
    }

    public function __toString(): string
    {
        return $this->format('Y-m-d');
    }

    public function jsonSerialize(): self
    {
        return $this;
    }

    abstract protected function validate(): void;
}
