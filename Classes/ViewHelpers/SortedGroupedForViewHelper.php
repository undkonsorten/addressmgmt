<?php namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Fluid\ViewHelpers\GroupedForViewHelper;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Felix Althaus <felix.althaus@undkonsorten.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the text file GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
class SortedGroupedForViewHelper extends GroupedForViewHelper {

    /**
     * @var \string
     */
    const ORDER_ASCENDING = 'asc';

    /**
     * @var \string
     */
    const ORDER_DESCENDING = 'desc';

    /**
     * registers additional arguments used by this viewhelper
     */
    public function initializeArguments() {
        $this->registerArgument('sortBy', 'string', 'Groups will be sorted by this property', FALSE, '');
        $this->registerArgument('order', 'string', 'Sorting order, asc or desc', FALSE, self::ORDER_ASCENDING);
        parent::initializeArguments();
    }

    /**
     * @param \array $elements
     * @param \string $groupBy
     * @return \array
     */
    protected function groupElements(array $elements, $groupBy) {
        $groups = parent::groupElements($elements, $groupBy);
        $sortBy = $this->arguments['sortBy'];
        $order = $this->arguments['order'];
        if ($sortBy && count($groups['keys'])) {
            $groups = $this->sortGroups($groups, $sortBy, $order);
        }
        return $groups;
    }

    /**
     * @param \array $groups
     * @return \array
     */
    protected function sortGroups($groups, $sortBy, $order) {
        ksort($groups['values']);
        $keys = array_keys($groups['values']);
        $groups['keys'] = array_combine($keys, $keys);
        return $groups;
    }

    /**
     * @param \integer|\float $a
     * @param \integer|\float $b
     */
    static protected function sortNumbers($a, $b) {
        return self::signum($a-$b);
    }

    /**
     * calculates signum of given number (-1|0|1)
     *
     * @param \number $number
     * @return \integer
     */
    static protected function signum($number) {
        return (int) ($number == 0 ? 0 : $number / abs($number));
    }

    /**
     * @param \Countable $a
     * @param \Countable $b
     * @return \integer
     */
    static protected function sortCountableByLength(\Countable $a, \Countable $b) {
        return self::sortNumbers(count($a), count($b));
    }

    /**
     * @param \mixed $object
     * @throws \Exception
     * @return \string|\array Callback function
     */
    protected function resolveComparisonFunction($object, $propertyPath) {
        if (!(ObjectAccess::isPropertyGettable($object, $propertyPath))) {
            throw new \Exception(sprintf('Object of type %s does not support getting property "%s".', get_class($object), $propertyPath), 1424171751);
        }
        $property = ObjectAccess::getPropertyPath($object, $propertyPath);
        if (is_int($property) || is_float($property)) {
            $sortingFunction = [self::class, 'sortNumbers'];
        } elseif (is_string($property)) {
            $sortingFunction = 'strnatcmp';
        } elseif ($property instanceof \Countable) {
            $sortingFunction = [self::class, 'sortCountableByLength'];
        } else {
            throw new \Exception(sprintf('%s only support numbers, strings or \Countable for comparison, %s given.', self::class, gettype($property)), 1424161601);
        }
        return $sortingFunction;
    }


}