<?php

declare(strict_types=1);

namespace spec\Yasumi;

use PhpSpec\ObjectBehavior;
use Yasumi\DateTimeSpan;

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
}
