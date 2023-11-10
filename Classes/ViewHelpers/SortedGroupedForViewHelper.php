<?php namespace Undkonsorten\Addressmgmt\ViewHelpers;


use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3Fluid\Fluid\ViewHelpers\GroupedForViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\Variables\VariableExtractor;
use TYPO3Fluid\Fluid\Core\ViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

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
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $each = $arguments['each'];
        $as = $arguments['as'];
        $groupBy = $arguments['groupBy'];
        $groupKey = $arguments['groupKey'];
        $output = '';
        if ($each === null) {
            return '';
        }
        if (is_object($each)) {
            if (!$each instanceof \Traversable) {
                throw new ViewHelper\Exception('GroupedForViewHelper only supports arrays and objects implementing \Traversable interface', 1253108907);
            }
            $each = iterator_to_array($each);
        }

        $groups = static::groupElements($each, $groupBy);
        $groups = static::sortElements($groups, $arguments['sortBy'],$arguments['order']);

        $templateVariableContainer = $renderingContext->getVariableProvider();
        foreach ($groups['values'] as $currentGroupIndex => $group) {
            $templateVariableContainer->add($groupKey, $groups['keys'][$currentGroupIndex]);
            $templateVariableContainer->add($as, $group);
            $output .= $renderChildrenClosure();
            $templateVariableContainer->remove($groupKey);
            $templateVariableContainer->remove($as);
        }
        return $output;
    }
    /**
     * @param \array $elements
     * @param \string $groupBy
     * @return \array
     */
    static protected function sortElements(array $groups, $sortBy, $order) {
        if ($sortBy && count($groups['keys'])) {
            $groups = static::sortGroups($groups);
        }
        return $groups;
    }

    /**
     * @param \array $groups
     * @return \array
     */
    static protected function sortGroups($groups) {
        ksort($groups['values']);
        $keys = array_keys($groups['values']);
        $groups['keys'] = array_combine($keys, $keys);
        return $groups;
    }





}
