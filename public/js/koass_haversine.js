function koass_getDistance(latlon1,latlon2,unit,cutDecimal) {

	// Set standards
    unit = unit || 'km'
    cutDecimal = cutDecimal || false

	// Assign vars
	var lat1 = latlon1[0]
	var lon1 = latlon1[1]
	var lat2 = latlon2[0]
	var lon2 = latlon2[1]

  // Converts degrees to Rads
  if (typeof(Number.prototype.toRad) === "undefined") {
    Number.prototype.toRad = function() {
      return this * Math.PI / 180;
    }
  }

	var R = '';
	if (unit == 'km') {
		R = 6371; // km
	} else {
		R = 6371000; // m
	}
		
	var dLat = (parseFloat(lat2)-parseFloat(lat1)).toRad();
	var dLon = (parseFloat(lon2)-parseFloat(lon1)).toRad();
	var lat1 = parseFloat(lat1).toRad();
	var lat2 = parseFloat(lat2).toRad();

	var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	var d = R * c;

	if (cutDecimal === false) {
		return d.toFixed(4);
	} else {
		return Math.round(d);
	}
};
