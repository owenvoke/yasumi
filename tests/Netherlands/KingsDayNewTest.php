<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2021 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Netherlands;

use Yasumi\Holiday;
use Yasumi\Provider\Netherlands\Kingsday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Kings Day in the Netherlands.
 */
class KingsDayNewTest extends NetherlandsBaseTestCase implements HolidayTestCase
{
    /**
     * Tests Kings Day on or after 2014. King's Day is celebrated from 2014 onwards on April 27th.
     *
     * @throws \Exception
     */
    public function testKingsDayOnAfter2014(): void
    {
        $year = 2021;

        $day = new Kingsday($year, self::TIMEZONE);
        echo $day->getKey();
        echo $day;
        echo $day->getTimezone()->getName();
        echo $day->isWorkingDay();

        echo \json_encode($day, JSON_THROW_ON_ERROR);
    }

    public function testTranslation(): void
    {
        // TODO: Implement testTranslation() method.
    }

    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            'kingsDayNew',
            $this->generateRandomYear(2014),
            Holiday::TYPE_OFFICIAL
        );
    }
}
