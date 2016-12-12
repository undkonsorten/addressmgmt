<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class MapConfigurationViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
  
    /**
     * 
     * @param string $id
     * @param string $accesssToken
     * @param integer $mapZoom
     * @param string $attribution
     */
    public function render($latitude, $longitude, $mapZoom, $padding) {
        $configuration = array('center' => array((float)$latitude, (float)$longitude), 'zoom' => (int)$mapZoom, 'padding' => (int)$padding);
        return json_encode($configuration, JSON_UNESCAPED_SLASHES);
    }
}
?>
