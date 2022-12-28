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

namespace Yasumi\Provider;

/**
 * This factory keep references to already instantiated DateTimeZone to save CPU time resources.
 *
 * @author Pierrick VIGNAND <pierrick.vignand@gmail.com>
 */
final class DateTimeZoneFactory
{
    /** @var array<string, \DateTimeZone>|null */
    private static ?array $dateTimeZones = null;

    public static function getDateTimeZone(string $timezone): \DateTimeZone
    {
        if (!isset(self::$dateTimeZones[$timezone])) {
            self::$dateTimeZones[$timezone] = new \DateTimeZone($timezone);
        }

        return self::$dateTimeZones[$timezone];
    }
}
