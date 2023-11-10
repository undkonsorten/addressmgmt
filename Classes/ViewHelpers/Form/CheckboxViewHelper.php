<?php

namespace Undkonsorten\Addressmgmt\ViewHelpers\Form;

/*                                                                        *
 * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper;

/**
 * View Helper which creates a simple checkbox (<input type="checkbox">).
 *
 * = Examples =
 *
 * <code title="Example">
 * <f:form.checkbox name="myCheckBox" value="someValue" />
 * </code>
 * <output>
 * <input type="checkbox" name="myCheckBox" value="someValue" />
 * </output>
 *
 * <code title="Preselect">
 * <f:form.checkbox name="myCheckBox" value="someValue" checked="{object.value} == 5" />
 * </code>
 * <output>
 * <input type="checkbox" name="myCheckBox" value="someValue" checked="checked" />
 * (depending on $object)
 * </output>
 *
 * <code title="Bind to object property">
 * <f:form.checkbox property="interests" value="TYPO3" />
 * </code>
 * <output>
 * <input type="checkbox" name="user[interests][]" value="TYPO3" checked="checked" />
 * (depending on property "interests")
 * </output>
 *
 * @api
 */
class CheckboxViewHelper extends AbstractFormFieldViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'input';

    /**
     * Initialize the arguments.
     *
     * @return void
     * @api
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerTagAttribute(
            'disabled', 'string', 'Specifies that the input element should be disabled when the page loads'
        );
        $this->registerArgument(
            'errorClass', 'string', 'CSS class to set if there are errors for this view helper', false, 'f3-form-error'
        );
        $this->overrideArgument('value', 'string', 'Value of input tag. Required for checkboxes', true);
        $this->registerArgument('required', 'boolean', 'If set no empty value is allowed.', false, false);
        $this->registerArgument('multiple', 'boolean', 'Specifies whether this checkbox belongs to a multivalue (is part of a checkbox group)', false, false);
        $this->registerArgument('checked', 'boolean', 'Specifies that the input element should be preselected', false, null);
        $this->registerUniversalTagAttributes();
    }

    /**
     * Renders the checkbox.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     * @return string
     * @api
     */
    public function render()
    {
        $checked = $this->arguments['checked'];
        $multiple = $this->arguments['multiple'];
        $this->tag->addAttribute('type', 'checkbox');

        $nameAttribute = $this->getName();
        $valueAttribute = $this->getValueAttribute();
        if ($this->arguments['required']) {
            $this->tag->addAttribute('required', 'required');
        }
        $propertyValue = null;
        if ($this->hasMappingErrorOccurred()) {
            $propertyValue = $this->getLastSubmittedFormData();
        }
        if ($checked === null && $propertyValue === null) {
            $propertyValue = $this->getPropertyValue();
        }

        if ($propertyValue instanceof \Traversable) {
            $propertyValue = iterator_to_array($propertyValue);
        }
        if (is_array($propertyValue)) {
            $propertyValue = array_map([$this, 'convertToPlainValue'], $propertyValue);
            if ($checked === null) {
                $checked = in_array($valueAttribute, $propertyValue);
            }
            $nameAttribute .= '[]';
        } elseif ($multiple === true) {
            $nameAttribute .= '[]';
        } elseif ($propertyValue !== null) {
            $checked = (boolean) $propertyValue === (boolean) $valueAttribute;
        }

        $this->registerFieldNameForFormTokenGeneration($nameAttribute);
        $this->tag->addAttribute('name', $nameAttribute);
        $this->tag->addAttribute('value', $valueAttribute);
        if ($checked === true) {
            $this->tag->addAttribute('checked', 'checked');
        }

        $this->setErrorClassAttribute();
        $hiddenField = $this->renderHiddenFieldForEmptyValue();
        return $hiddenField . $this->tag->render();
    }
}
