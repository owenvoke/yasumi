<?php

declare(strict_types=1);
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Exception;

use Exception as BaseException;

class MissingTranslationException extends BaseException implements Exception
{
    /**
     * @param string                $key     the holiday key
     * @param array<string, string> $locales the locales that were searched
     */
    public function __construct(string $key, array $locales)
    {
        parent::__construct(\sprintf("Translation for '%s' not found for any locale: '%s'", $key, \implode("', '", $locales)));
    }
}
