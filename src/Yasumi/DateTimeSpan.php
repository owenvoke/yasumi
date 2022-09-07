<?php

declare(strict_types=1);

namespace Yasumi;

use Yasumi\Exception\InvalidDateTimeSpanException;

class DateTimeSpan implements \Stringable
{
    public const YEAR_LOWER_BOUND = 1000;

    private const FORMAT = 'c';

    public function __construct(private \DateTimeInterface $start, private \DateTimeInterface $end)
    {
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
     * @return array{start: string, end: string}
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
            if ($this->start < (new \DateTimeImmutable($lower))) {
                throw new InvalidDateTimeSpanException(sprintf('start date needs to be %s or later (%s given)', $lower, $this->start->format(self::FORMAT)));
            }
        } catch (\Throwable $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        if ($this->start > $this->end) {
            throw new InvalidDateTimeSpanException('end date must be after start date');
        }
    }
}
