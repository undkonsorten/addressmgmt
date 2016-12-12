<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class MarkerViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
  
    /**
     * 
     * @param string $id
     * @param string $accesssToken
     * @param integer $maxZoom
     * @param string $attribution
     */
    public function render($latitude = NULL, $longitude = NULL , $geoJson = NULL) {
        $configuration = array();
        if($latitude && $longitude){
            $configuration = array('type' => 'marker','coordinates' => array((float)$latitude, (float)$longitude));
        }
        if($geoJson != ""){
           $geoJson = json_decode(str_replace('&quot;', '"', $geoJson),true);
           $configuration = array('type' => 'geoJson','geoJson' =>$geoJson);
        }
        return json_encode($configuration);
    }
}
?>
