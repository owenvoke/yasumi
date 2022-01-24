<?php

declare(strict_types=1);

namespace Yasumi\tests;

use PHPUnit\Framework\TestCase;
use Yasumi\DateTimeSpan;
use Yasumi\Exception\InvalidDateTimeSpanException;

class DateTimeSpanTest extends TestCase
{
    public function testHasStartDateTime(): void
    {
        $start = new \DateTimeImmutable('2022-01-22');

        $timespan = new DateTimeSpan($start, new \DateTimeImmutable('2022-04-03'));

        self::assertEquals($start, $timespan->getStart());
    }

    public function testHasEndDateTime(): void
    {
        $end = new \DateTimeImmutable('2022-04-03');

        $timespan = new DateTimeSpan(new \DateTimeImmutable('2022-01-22'), $end);

        self::assertEquals($end, $timespan->getEnd());
    }

    public function testToArray(): void
    {
        $start = new \DateTimeImmutable('2022-01-18');
        $end = new \DateTimeImmutable('2022-01-19');

        $timespan = new DateTimeSpan($start, $end);

        self::assertIsArray($timespan->toArray());
        self::assertEquals([
            'start' => '2022-01-18T00:00:00+00:00',
            'end' => '2022-01-19T00:00:00+00:00',
        ], $timespan->toArray());
    }

    public function testToString(): void
    {
        $start = new \DateTimeImmutable('2022-01-18');
        $end = new \DateTimeImmutable('2022-04-03');

        $timespan = new DateTimeSpan($start, $end);

        self::assertEquals('2022-01-18T00:00:00+00:00 - 2022-04-03T00:00:00+00:00', (string) $timespan);
    }

    public function testItThrowsExceptionWhenEndIsBeforeStart(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('end date must be after start date');

        $start = new \DateTimeImmutable('2022-01-18');
        $end = new \DateTimeImmutable('2022-01-17');

        $timespan = new DateTimeSpan($start, $end);
    }

    public function testLowerDateTimeSpanBoundary(): void
    {
        $this->expectException(InvalidDateTimeSpanException::class);
        $this->expectExceptionMessage('start date needs to be 1000-01-01 or later (0634-12-23T00:00:00+00:00 given)');

        $start = new \DateTimeImmutable('634-12-23');
        $end = new \DateTimeImmutable('5976-01-17');

        $timespan = new DateTimeSpan($start, $end);
    }

    public function testUpperDateTimeSpanBoundary(): void
    {
        $this->expectException(InvalidDateTimeSpanException::class);
        $this->expectExceptionMessage('end date must be after start date');

        $start = new \DateTimeImmutable('4343-12-23');
        $end = new \DateTimeImmutable('12010-01-17');

        $timespan = new DateTimeSpan($start, $end);
    }
}
