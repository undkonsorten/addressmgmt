h1. Addressmanagement (addressmgmt)

The Adressmanagement extension is solution for replacing the old tt_address. It is mulitlingual, comes along with list and single view and also includes a map (with MapBox).

h2. Map

The map is connected with MapBox.com:http://mapbox.com. You will need to create an account.
With each address item can have store the geoposition (Lat, Lang) or you can also add a GeoJson in a format like

<pre>
{"type":"Feature","geometry":{"type":"Polygon","coordinates":[[[13.47791940161274,51.45391309412658], ...[13.47791940161274,51.45391309412658]]]}}
</pre>

To see the map you need to insert the Plugin "Address Management", What to display: "List", Show Items by: "Select Manually".

h3. TypoScript Settings / Constants for the Map:

h4. Constants

plugin.tx_addressmgmt {	
	settings{
		# cat=plugin.tx_addressmgmt//b; type=string; label=Map Id (Mapbox.com)
		mapId = 
		# cat=plugin.tx_addressmgmt//c; type=string; label=Access Token (Mapbox.com)
		accessToken = 
		# cat=plugin.tx_addressmgmt//d; type=string; label=Longitude
		longitude =
		# cat=plugin.tx_addressmgmt//e; type=string; label=Latitude
		latitude =
		# cat=plugin.tx_addressmgmt//f; type=string; label=Map Zoom
		mapZoom = 
		# cat=plugin.tx_addressmgmt//g; type=string; label=Max Zoom
		maxZoom = 
		# cat=plugin.tx_addressmgmt//h; type=string; label=Override flexform fields if empty
		overrideFlexformSettingsIfEmpty = mapId, accessToken, longitude, latitude, mapZoom, maxZoom
	}
}

h4. Setup

plugin.tx_addressmgmt {
	settings{
		overrideFlexformSettingsIfEmpty = {$plugin.tx_addressmgmt.settings.overrideFlexformSettingsIfEmpty}
		mapId = {$plugin.tx_addressmgmt.settings.mapId}
		accessToken = {$plugin.tx_addressmgmt.settings.accessToken}
		longitude = {$plugin.tx_addressmgmt.settings.longitude}
		latitude = {$plugin.tx_addressmgmt.settings.latitude}
		mapZoom = {$plugin.tx_addressmgmt.settings.mapZoom}
		maxZoom = {$plugin.tx_addressmgmt.settings.maxZoom}
	}
}
