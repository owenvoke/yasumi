<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2022 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\Luxembourg;

use Yasumi\Holiday;
use Yasumi\Provider\Luxembourg;
use Yasumi\tests\ProviderTestCase;

/**
 * Class for testing holidays in Luxembourg.
 */
class LuxembourgTest extends LuxembourgBaseTestCase implements ProviderTestCase
{
    /**
     * @var int year random year number used for all tests in this Test Case
     */
    protected int $year;

    /**
     * Tests if all official holidays in Luxembourg are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testOfficialHolidays(): void
    {
        $holidays = [
            'newYearsDay',
            'easterMonday',
            'internationalWorkersDay',
            'ascensionDay',
            'pentecostMonday',
            'nationalDay',
            'assumptionOfMary',
            'allSaintsDay',
            'christmasDay',
            'secondChristmasDay',
        ];

        $year = $this->generateRandomYear();

        if ($year >= Luxembourg::EUROPE_DAY_START_YEAR) {
            $holidays[] = 'europeDay';
        }

        $this->assertDefinedHolidays($holidays, self::REGION, $year, Holiday::TYPE_OFFICIAL);
    }

    /**
     * Tests if all observed holidays in Luxembourg are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testObservedHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OBSERVANCE);
    }

    /**
     * Tests if all seasonal holidays in Luxembourg are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testSeasonalHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_SEASON);
    }

    /**
     * Tests if all bank holidays in Luxembourg are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testBankHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_BANK);
    }

    /**
     * Tests if all other holidays in Luxembourg are defined by the provider class.
     *
     * @throws \Exception
     */
    public function testOtherHolidays(): void
    {
        $this->assertDefinedHolidays([], self::REGION, $this->generateRandomYear(), Holiday::TYPE_OTHER);
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function testSources(): void
    {
        $this->assertSources(self::REGION, 2);
    }
}
