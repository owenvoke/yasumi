<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Filters;

use Countable;
use FilterIterator;
use Yasumi\Holiday;

/**
 * BankHolidaysFilter is a class for filtering all bank holidays.
 *
 * BankHolidaysFilter is a class that returns all holidays that are considered bank holidays of any given holiday
 * provider.
 *
 * Example usage:
 * $holidays = Yasumi::create('Netherlands', 2015);
 * $bank = new BankHolidaysFilter($holidays->getIterator());
 */
class BankHolidaysFilter extends FilterIterator implements Countable
{
    /**
     * Checks whether the current element of the iterator is an observed holiday.
     *
     * @return bool
     */
    public function accept(): bool
    {
        return $this->getInnerIterator()->current()->getType() === Holiday::TYPE_BANK;
    }

    /**
     * @return integer Returns the number of filtered holidays.
     */
    public function count(): int
    {
        $days = array_keys(iterator_to_array($this));

        array_walk($days, function (&$day) {
            $day = str_replace('substituteHoliday:', '', $day);
        });

        return count(array_unique($days));
    }
}
