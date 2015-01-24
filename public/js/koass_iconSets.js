//#########################################################################
// Iconsets for use in KOAss application / openlayers3
//#########################################################################

// Fellesdata
var koass_aprsIconInfo = {
	offset: [0, 0],
	opacity: 1.0,
	rotateWithView: false,
	rotation: 0.0,
	scale: 1.0
};
/*
  var symbolCount = aprsSymbolList.length;
  var aprsIcons = new Array(symbolCount);
*/  
  var koass_aprsIcons = new Array(1);
  for (i = 0; i < 1; ++i) {
//    var aprsSymbols = aprsSymbolList[i];

    koass_aprsIcons[i] = new ol.style.Icon({
//		anchor: [0.5, 46],
//		anchorXUnits: 'fraction',
//		anchorYUnits: 'pixels',
		offset: koass_aprsIconInfo.offset,
		opacity: koass_aprsIconInfo.opacity,
		rotateWithView: koass_aprsIconInfo.rotateWithView,
		rotation: koass_aprsIconInfo.rotation,
		scale: koass_aprsIconInfo.scale,
		size: koass_aprsIconInfo.size,
		src: 'img/icons/circle_x.svg'
    });

    koass_aprsIcons[1] = new ol.style.Icon({
		offset: koass_aprsIconInfo.offset,
		opacity: koass_aprsIconInfo.opacity,
		rotateWithView: koass_aprsIconInfo.rotateWithView,
		rotation: koass_aprsIconInfo.rotation,
		scale: koass_aprsIconInfo.scale,
		size: koass_aprsIconInfo.size,
		src: 'img/house-1.png'
    });
	}

	// Text
	var koass_aprsText = new ol.style.Text({
		font: '12px helvetica,sans-serif',
//		text: "lala",
		rotation: 0,
		fill: new ol.style.Fill({
			color: '#000'
		}),
		stroke: new ol.style.Stroke({
			color: '#fff',
			width: 2
		})
	})

//#########################################################################
// APRS symbols
//#########################################################################
var koass_aprsStyle = new ol.style.Style({
  image: koass_aprsIcons,
  text: koass_aprsText
});

//
var aprsPri;
var aprsAlt;
var aprsNum;
var aprsLet;

