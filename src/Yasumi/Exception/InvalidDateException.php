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

namespace Yasumi\Exception;

class InvalidDateException extends \InvalidArgumentException implements Exception
{
    /**
     * @param mixed $argumentValue the value of the invalid argument
     */
    public function __construct($argumentValue)
    {
        $type = \gettype($argumentValue);
        $displayName = match ($type) {
            'boolean' => $argumentValue ? 'true' : 'false',
            'integer', 'double' => (string) $argumentValue,
            'string' => $argumentValue,
            'object' => $argumentValue::class,
            default => $type,
        };

        parent::__construct(sprintf('\'%s\' is not a valid DateTime(Immutable) instance', $displayName));
    }
}
