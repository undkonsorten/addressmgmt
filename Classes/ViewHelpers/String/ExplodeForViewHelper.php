<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers\String;

    /*                                                                        *
     * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
     *                                                                        *
     * It is free software; you can redistribute it and/or modify it under    *
     * the terms of the GNU Lesser General Public License, either version 3   *
     *  of the License, or (at your option) any later version.                *
     *                                                                        *
     * The TYPO3 project - inspiring people to share!                         *
     *                                                                        */

    use TYPO3\CMS\Core\Utility\GeneralUtility;
    use TYPO3\CMS\Extbase\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
    use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * Loop view helper which can be used to interate over array.
 * Implements what a basic foreach()-PHP-method does.
 *
 * = Examples =
 *
 * <code title="Simple Loop">
 * <f:for each="{0:1, 1:2, 2:3, 3:4}" as="foo">{foo}</f:for>
 * </code>
 * <output>
 * 1234
 * </output>
 *
 * <code title="Output array key">
 * <ul>
 *   <f:for each="{fruit1: 'apple', fruit2: 'pear', fruit3: 'banana', fruit4: 'cherry'}" as="fruit" key="label">
 *     <li>{label}: {fruit}</li>
 *   </f:for>
 * </ul>
 * </code>
 * <output>
 * <ul>
 *   <li>fruit1: apple</li>
 *   <li>fruit2: pear</li>
 *   <li>fruit3: banana</li>
 *   <li>fruit4: cherry</li>
 * </ul>
 * </output>
 *
 * <code title="Iteration information">
 * <ul>
 *   <f:for each="{0:1, 1:2, 2:3, 3:4}" as="foo" iteration="fooIterator">
 *     <li>Index: {fooIterator.index} Cycle: {fooIterator.cycle} Total: {fooIterator.total}{f:if(condition: fooIterator.isEven, then: ' Even')}{f:if(condition: fooIterator.isOdd, then: ' Odd')}{f:if(condition: fooIterator.isFirst, then: ' First')}{f:if(condition: fooIterator.isLast, then: ' Last')}</li>
 *   </f:for>
 * </ul>
 * </code>
 * <output>
 * <ul>
 *   <li>Index: 0 Cycle: 1 Total: 4 Odd First</li>
 *   <li>Index: 1 Cycle: 2 Total: 4 Even</li>
 *   <li>Index: 2 Cycle: 3 Total: 4 Odd</li>
 *   <li>Index: 3 Cycle: 4 Total: 4 Even Last</li>
 * </ul>
 * </output>
 *
 * @api
 */
class ExplodeForViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper implements CompilableInterface
{
    protected $escapeOutput = false;
    /**
     * Iterates through elements of $each and renders child nodes
     *
     * @return string Rendered string
     * @api
     */
    public function render()
    {
        return static::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * Initializes the arguments for the ViewHelper
     */
    public function initializeArguments()
    {
        $this->registerArgument('each', 'mixed', 'The array or string or \TYPO3\CMS\Extbase\Persistence\ObjectStorage to iterated over', true);
        $this->registerArgument('as', 'string', 'The name of the iteration variable', true);
        $this->registerArgument('key', 'string', 'The name of the variable to store the current array key', false);
        $this->registerArgument('reverse', 'bool', 'If enabled, the iterator will start with the last element and proceed reversely', false);
        $this->registerArgument('iteration', 'string', 'The name of the variable to store iteration information (index, cycle, isFirst, isLast, isEven, isOdd)', false);
        $this->registerArgument('delimiter', 'string', 'Delimiter sign to explode the string on this character', false);
    }


    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     * @return string
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface $renderingContext)
    {
        $templateVariableContainer = $renderingContext->getVariableProvider();
        if ($arguments['each'] === null) {
            return '';
        }
        if (is_string($arguments['each'])) {
            (empty($arguments['delimiter'])) ? $delimiter = ',' : $delimiter = $arguments['delimiter'];
            $arguments['each'] = GeneralUtility::trimExplode($delimiter,$arguments['each'],true);
        }
        if (is_object($arguments['each']) && !$arguments['each'] instanceof \Traversable) {
            throw new \TYPO3Fluid\Fluid\Core\ViewHelper\Exception('ForViewHelper only supports arrays and objects implementing \Traversable interface', 1248728393);
        }

        if ($arguments['reverse'] === true) {
            // array_reverse only supports arrays
            if (is_object($arguments['each'])) {
                $arguments['each'] = iterator_to_array($arguments['each']);
            }
            $arguments['each'] = array_reverse($arguments['each']);
        }
        if ($arguments['iteration'] !== null) {
            $iterationData = [
                'index' => 0,
                'cycle' => 1,
                'total' => count($arguments['each'])
            ];
        }

        $output = '';
        foreach ($arguments['each'] as $keyValue => $singleElement) {
            $templateVariableContainer->add($arguments['as'], $singleElement);
            if ($arguments['key'] !== '') {
                $templateVariableContainer->add($arguments['key'], $keyValue);
            }
            if ($arguments['iteration'] !== null) {
                $iterationData['isFirst'] = $iterationData['cycle'] === 1;
                $iterationData['isLast'] = $iterationData['cycle'] === $iterationData['total'];
                $iterationData['isEven'] = $iterationData['cycle'] % 2 === 0;
                $iterationData['isOdd'] = !$iterationData['isEven'];
                $templateVariableContainer->add($arguments['iteration'], $iterationData);
                $iterationData['index']++;
                $iterationData['cycle']++;
            }
            $output .= $renderChildrenClosure();
            $templateVariableContainer->remove($arguments['as']);
            if ($arguments['key'] !== '') {
                $templateVariableContainer->remove($arguments['key']);
            }
            if ($arguments['iteration'] !== null) {
                $templateVariableContainer->remove($arguments['iteration']);
            }
        }
        return $output;
    }
}
