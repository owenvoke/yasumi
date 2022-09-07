<?php

declare(strict_types=1);

namespace Yasumi\Provider\Netherlands;

use Yasumi\HolidayNew;
use Yasumi\Provider\DateTimeZoneFactory;

final class Kingsday extends HolidayNew
{
    public function __construct(int $year, string $timezone)
    {
        if ($year < 2014) {
            throw new \DomainException('nonon');
        }

        $date = new \DateTime(\sprintf('%s-4-27', $year), DateTimeZoneFactory::getDateTimeZone($timezone));

        if (0 === (int) $date->format('w')) {
            $date->sub(new \DateInterval('P1D'));
        }

        parent::__construct($date);
    }

    public function getKey(): string
    {
        return 'kingsDayNew';
    }

    public function getType(): string
    {
        return 'official';
    }

    public function isWorkingDay(): bool
    {
        return false;
    }

    protected function validate(): void
    {
    }
}
