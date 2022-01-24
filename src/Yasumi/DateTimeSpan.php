<?php

declare(strict_types=1);

namespace Yasumi;

use Yasumi\Exception\InvalidDateTimeSpanException;

class DateTimeSpan
{
    public const YEAR_LOWER_BOUND = 1000;

    private const FORMAT = 'c';

    private \DateTimeInterface $start;

    private \DateTimeInterface $end;

    public function __construct(\DateTimeInterface $start, \DateTimeInterface $end)
    {
        $this->start = $start;
        $this->end = $end;

        $this->validate();
    }

    public function __toString(): string
    {
        return sprintf(
            '%s - %s',
            $this->start->format(self::FORMAT),
            $this->end->format(self::FORMAT),
        );
    }

    public function getStart(): \DateTimeInterface
    {
        return $this->start;
    }

    public function getEnd(): \DateTimeInterface
    {
        return $this->end;
    }

    /**
     * @return array<string>
     */
    public function toArray(): array
    {
        return [
            'start' => $this->start->format(self::FORMAT),
            'end' => $this->end->format(self::FORMAT),
        ];
    }

    private function validate(): void
    {
        $lower = self::YEAR_LOWER_BOUND.'-01-01';
        try {
            $lowerDate = new \DateTimeImmutable($lower);

            if ($this->start < $lowerDate) {
                throw new InvalidDateTimeSpanException(sprintf('start date needs to be %s or later (%s given)', $lower, $this->start->format(self::FORMAT)));
            }
        } catch (\Throwable $e) {
            throw new \RuntimeException($e->getMessage());
        }

        if ($this->start > $this->end) {
            throw new InvalidDateTimeSpanException('end date must be after start date');
        }
    }
}
