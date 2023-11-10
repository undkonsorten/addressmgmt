<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Resource\FilePathSanitizer;

class GoogleMapViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
	
	protected $tagName = 'div';
	
	/**
	 * Prefix for attributes
	 * @var \string
	 */
	const ATTRIBUTE_PREFIX = 'data-';
	
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerUniversalTagAttributes();
        $this->registerArgument('latitude', 'float', 'Latitude data', false, null);
        $this->registerArgument('longitude', 'float', 'Longitude data', false, null);
        $this->registerArgument('mapZoom', 'integer', 'Map zoom', false, null);
        $this->registerArgument('markerAtCenter', 'boolean', 'Marker At Center', false, null);
        $this->registerArgument('markerTitle', 'string', 'Marker Title', false, null);
	}

    /**
	 * @todo add description here
	 *
     * @return string
	 */ 
	public function render($latitude = NULL, $longitude = NULL, $mapZoom = NULL, $markerAtCenter = NULL, $markerTitle = NULL) {
	    [
	        'latitude' => $latitude,
	        'longitude' => $longitude,
	        'mapZoom' => $mapZoom,
	        'markerAtCenter' => $markerAtCenter,
	        'markerTitle' => $markerTitle,
        ] = $this->arguments;

		$settings = $this->templateVariableContainer->get('settings') ? : [];
		$this->tag->addAttribute('class', 'map');
		$dataAttributes = [
			self::ATTRIBUTE_PREFIX . 'latitude' => floatval($latitude ? : $settings['latitude']),
			self::ATTRIBUTE_PREFIX . 'longitude' => floatval($longitude ? : $settings['longitude']),
			self::ATTRIBUTE_PREFIX . 'mapzoom' => intval($mapZoom ? : $settings['mapZoom']),
			self::ATTRIBUTE_PREFIX . 'markeratcenter' => !is_null($markerAtCenter) ? $markerAtCenter : !!$settings['markerAtCenter'],
			self::ATTRIBUTE_PREFIX . 'markertitle' => strlen($markerTitle) ? $markerTitle : $settings['markerTitle'],
		];
		$dataAttributes = array_filter($dataAttributes, function($value) { return !is_null($value); });
		$this->tag->addAttributes($dataAttributes);
		$this->tag->forceClosingTag(TRUE);
		foreach($settings['includeJSFooter'] ? : [] as $footerFile) {
			$this->getPageRenderer()->addJsFooterFile($this->resolveResourcePath($footerFile));
		}
		foreach($settings['includeJSFooterlibs'] ? : [] as $libraryName => $libraryFile) {
			$this->getPageRenderer()->addJsFooterLibrary($libraryName, $this->resolveResourcePath($libraryFile));
		}
		return $this->tag->render();
	}
	
	/**
	 * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 */
	protected function getTyposcriptFrontendController() {
		return $GLOBALS['TSFE'];
	}
	
	/**
	 * @return \TYPO3\CMS\Core\TypoScript\TemplateService
	 */
	protected function getTemplateService() {
		return $this->getTyposcriptFrontendController()->tmpl;
	}
	
	/**
	 * @return \TYPO3\CMS\Core\Page\PageRenderer
	 */
	protected function getPageRenderer() {
		return $this->getTyposcriptFrontendController()->getPageRenderer();
	}
	
	/**
	 * @param \string $path
	 * @return \string
	 */
	protected function resolveResourcePath($path) {
		return GeneralUtility::makeInstance(FilePathSanitizer::class)->sanitize((string)$path);
	}
	
}
