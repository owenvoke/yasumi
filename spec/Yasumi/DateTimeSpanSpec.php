<?php

declare(strict_types=1);

namespace spec\Yasumi;

use PhpSpec\ObjectBehavior;
use Yasumi\DateTimeSpan;
use Yasumi\Exception\InvalidDateTimeSpanException;

final class DateTimeSpanSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith(new \DateTimeImmutable('2000-01-01'), new \DateTimeImmutable('2023-12-31'));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeSpan::class);
    }

    public function it_can_be_representated_as_a_string(): void
    {
        $this->shouldImplement(\Stringable::class);
        $this->__toString()->shouldBe('2000-01-01T00:00:00+00:00 - 2023-12-31T00:00:00+00:00');
    }

    public function it_can_be_representated_as_an_array(): void
    {
        $this->toArray()->shouldBe(
            [
              'start' => '2000-01-01T00:00:00+00:00',
              'end' => '2023-12-31T00:00:00+00:00',
            ]
        );
    }

    public function it_can_get_the_start_date(): void
    {
        $this->getStart()->shouldBeLike(new \DateTimeImmutable('2000-01-01 00:00:00'));
    }

    public function it_can_get_the_end_date(): void
    {
        $this->getEnd()->shouldBeLike(new \DateTimeImmutable('2023-12-31 00:00:00'));
    }

    public function it_should_throw_an_exception_when_start_date_preceeds_lower_bound(): void
    {
        $this->beConstructedWith(new \DateTimeImmutable('843-01-01'), new \DateTimeImmutable('2023-12-31'));

        $this->shouldThrow(new InvalidDateTimeSpanException('start date needs to be 1000-01-01 or later (0843-01-01T00:00:00+00:00 given)'))->duringInstantiation();
    }

    public function it_should_throw_an_exception_when_end_date_exceeds_upper_bound(): void
    {
        $this->beConstructedWith(new \DateTimeImmutable('2019-01-01'), new \DateTimeImmutable('10000-12-31'));

        $this->shouldThrow(new InvalidDateTimeSpanException('end date needs to be 9999-12-31 or earllier (10000-12-31T00:00:00+00:00 given)'))->duringInstantiation();
    }
}
