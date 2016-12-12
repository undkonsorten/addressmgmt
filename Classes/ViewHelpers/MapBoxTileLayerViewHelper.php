<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;
class MapBoxTileLayerViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
  
    /**
     * 
     * @param string $id
     * @param string $accesssToken
     * @param integer $maxZoom
     * @param string $attribution
     */
    public function render($id, $accesssToken, $maxZoom = 16, $attribution = "") {
        $result = array(
            'urlTemplate' => 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}',
            'options' => array(
                'attribution' => $attribution,
                'maxZoom' => (int)$maxZoom,
                'id' => $id,
                'accessToken' => $accesssToken
            )
        );
        return json_encode($result, JSON_UNESCAPED_SLASHES);
    }
}
?>
