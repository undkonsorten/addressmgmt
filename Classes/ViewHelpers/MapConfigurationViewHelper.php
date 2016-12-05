<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class MapConfigurationViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
  
    /**
     * 
     * @param string $id
     * @param string $accesssToken
     * @param integer $maxZoom
     * @param string $attribution
     */
    public function render($latitude, $longitude, $zoom, $padding) {
        $configuration = array('center' => array('latitude' => $latitude, 'longitude' => $longitude), 'zoom' => $zoom, 'padding' => $padding);
        return json_encode($configuration);
    }
}
?>