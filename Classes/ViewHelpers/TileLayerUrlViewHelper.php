<?php


namespace Undkonsorten\Addressmgmt\ViewHelpers;




use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class TileLayerUrlViewHelper extends AbstractViewHelper
{
    /**
     * Constructor
     *
     * @api
     */
    public function __construct()
    {
        $this->registerArgument('additionalAttributes', 'array', 'Additional tag attributes. They will be added directly to the resulting HTML tag.', false);
    }

    /**
     * Replaces newline characters by HTML line breaks.
     *
     * @return string the altered string.
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
     * @param array $arguments
     * @param callable $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        if (isset($arguments['additionalAttributes']) && is_array($arguments['additionalAttributes'])) {
            $content = $arguments['additionalAttributes'];
        } else {
            $content = $renderChildrenClosure();
        }
        $url = str_replace('{id}',$content['options']['id'],$content['urlTemplate']);
        $url = str_replace('{accessToken}',$content['options']['accessToken'],$url);

        return $url;
    }

}
