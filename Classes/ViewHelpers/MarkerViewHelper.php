<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class MarkerViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Arguments initialization
     *
     */
    public function initializeArguments()
    {
        $this->registerArgument('latitude', 'float', 'Latitude data', false, null);
        $this->registerArgument('longitude', 'float', 'Longitude data', false, null);
        $this->registerArgument('geoJson', 'string', 'GeoJson data', false, null);
    }
  
    /**
     * @todo add description here
     *
     * @return array
     */
    public function render() {
        [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'geoJson' => $geoJson
        ] = $this->arguments;

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
