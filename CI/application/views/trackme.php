<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>LE9KO - MobileTracker</title>
  </head>
  <body>
	<script>
 
    function initGeolocation() {
		if (navigator && navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
		} else {
			console.log('Geolocation is not supported');
        }
	}
 
	function errorCallback() {}
 
	function successCallback(position) {
		console.log(position);
	}
	
	</script>
<ul>
<li>preSjekk: geoCapable?</li>
<li>HendelsesID satt? || spør!</li>
<li>Ønsket Label</li>
<li>Start/Stop sporing</li>
</ul>

<pre>
http://diveintohtml5.info/geolocation.html
coords.latitude	double	decimal degrees
coords.longitude	double	decimal degrees
coords.altitude	double or null	meters above the reference ellipsoid
coords.accuracy	double	meters
coords.altitudeAccuracy	double or null	meters
coords.heading	double or null	degrees clockwise from true north
coords.speed	double or null	meters/second
timestamp	DOMTimeStamp	like a Date() object
</pre>

  </body>
</html>