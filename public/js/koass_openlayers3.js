/*
Definer view å sett opp openlayers3 for "population"
*/
//View(s)
var koass_View =  new ol.View({
	projection: projection,
	scale: statKart_scale,
	center: [1572378.549806288, 9963627.597984985],
	zoom: 10
})

// Sveiv i gang openlayers
var map = new ol.Map({
  target: "mapDiv",
  controls: [],
  view: koass_View
})



/*
Sett opp layers og layerGroups
LAYERSTACK::

#DRAWINGS
drawLayers
 drawLayerClient
 drawLayerServer // shared (nonEdit?)

#POINTS OF INTEREST
poiLayers
 poiLayerAPRS
 poiLayerAIP
 poiLayerModeS
 poiLayerInternetGW
 
#INFO
infoLayers
  infoLayerWeather
  infoLayerNASA

#MAPS
mapLayers
 mapLayerStatensKartverk
 mapLayerBing
 mapLayerBing_airial
 mapLayerBing_satelite
 mapLayerOSM
 mapLayerOSM_osm
 mapLayerOSM_sat
 mapLayerOSM_hyb
 mapLayerMapQuest
 mapLayerStamen
 mapLayerStamen_terrain
 mapLayerStamen_water

*/

//### mapLayers ############################################### //
var mapLayers = new ol.layer.Group({
	id: "mapLayers",
	name:"mapLayers",
  visible: true,
});
map.addLayer(mapLayers);



  //## mapLayerStamen  ######################## //
  var mapLayersStamen = new ol.layer.Group({
	  id: "mapLayersStamen",
	  name:"mapLayersStamen",
    visible: true
  });
  mapLayers.getLayers().push(mapLayersStamen);

	    //## Stamen water
      var mapLayerStamen_water = new ol.layer.Tile({
          source: new ol.source.Stamen({
              layer: 'watercolor'
          }),
          name: 'mapLayerStamen_Watercolor'
      });
	    mapLayersStamen.getLayers().push(mapLayerStamen_water);

	    //## Stamen toner
      var mapLayerStamen_toner = new ol.layer.Tile({
          visible: false,
          source: new ol.source.Stamen({
              layer: 'toner'
          }),
          name: 'mapLayerStamen_Toner'
      });
	    mapLayersStamen.getLayers().push(mapLayerStamen_toner);




  //## mapLayerMQ  ######################## //
  var mapLayersMQ = new ol.layer.Group({
	  id: "mapLayersMQ",
	  name:"mapLayersMQ",
    visible: false
  });
  mapLayers.getLayers().push(mapLayersMQ);


 	    //## mapLayerMQ_osm
      var mapLayerMQ_osm = new ol.layer.Tile({
          source: new ol.source.MapQuest({
              layer: 'osm'
          }),
          name: 'MapQuest_osm'
      });
	    mapLayersMQ.getLayers().push(mapLayerMQ_osm);

	    //## mapLayerMQ_sat
      var mapLayerMQ_sat = new ol.layer.Tile({
          source: new ol.source.MapQuest({
              layer: 'sat'
          }),
          name: 'MapQuest_satelite'
      });
	    mapLayersMQ.getLayers().push(mapLayerMQ_sat);

	    //## mapLayerMQ_hyb
      var mapLayerMQ_hyb = new ol.layer.Tile({
          source: new ol.source.MapQuest({
              layer: 'hyb'
          }),
          name: 'MapQuest_hybrid'
      });
	    mapLayersMQ.getLayers().push(mapLayerMQ_hyb);






  //## mapLayerOSM  ######################## //
  var mapLayersOSM = new ol.layer.Group({
	  id: "mapLayersOSM",
	  name:"mapLayersOSM",
    visible: false
  });
  mapLayers.getLayers().push(mapLayersOSM);


	    //## mapLayerOSM_Land
	    var mapLayerOSM_Land = new ol.layer.Tile({
	      name: "OpenStreetMap",
	      source: new ol.source.OSM(),
	      opacity: 0.4
	    });
	    mapLayersOSM.getLayers().push(mapLayerOSM_Land);

	    //## mapLayerOSM_Sea
		var mapLayerOSM_Sea = new ol.layer.Tile({
			name: "OpenSeaMap",
			source: new ol.source.OSM({
			  attributions: [
				new ol.Attribution({
				  html: 'All maps &copy; ' +
					  '<a href="http://www.openseamap.org/">OpenSeaMap</a>'
				}),
				ol.source.OSM.DATA_ATTRIBUTION
			  ],
			  crossOrigin: null,
			  url: 'http://tiles.openseamap.org/seamark/{z}/{x}/{y}.png'
			})
		});
	    mapLayersOSM.getLayers().push(mapLayerOSM_Sea);

	    //## mapLayerOSM_Land
	    var mapLayerOSM_Weather = new ol.layer.Tile({
	      name: "OpenWeatherMap",
	      source: new ol.source.OSM({
			crossOrigin: null,
			url: 'http://undefined.tile.openweathermap.org/map/precipitation/${z}/${x}/${y}.png'
		  }),
	      opacity: 0.4
	    });
	    mapLayersOSM.getLayers().push(mapLayerOSM_Weather);






	//## mapLayerBing ######################## //
	var BingKey = 'AsCDnmotrTbJLIe2pslxg1olzZKr435tgIC2DS5NJUsqQuGP0tQ8euAEMifP_yjm';
	var mapLayersBing = new ol.layer.Group({
	  id: "mapLayersBing",
	  name:"mapLayersBing",
	visible: false
	});
	mapLayers.getLayers().push(mapLayersBing);

	    //## mapLayerBing_Road
	    var mapLayerBing_Road = new ol.layer.Tile({
	      name: "Bing_Road",
        source: new ol.source.BingMaps({
          key: BingKey,
          imagerySet: 'Road'
        })
	    });
	    mapLayersBing.getLayers().push(mapLayerBing_Road);

	    //## mapLayerBing_Aerial
	    var mapLayerBing_Aerial = new ol.layer.Tile({
        name: "Bing_Aerial",
        source: new ol.source.BingMaps({
          key: BingKey,
          imagerySet: 'Aerial'
        })
	    });
	    mapLayersBing.getLayers().push(mapLayerBing_Aerial);

	    //## mapLayerBing_AerialWithLabels
	    var mapLayerBing_AerialWithLabels = new ol.layer.Tile({
	      name: "Bing_AerialWithLabels",
        source: new ol.source.BingMaps({
          key: BingKey,
          imagerySet: 'AerialWithLabels'
        })
	    });
	    mapLayersBing.getLayers().push(mapLayerBing_AerialWithLabels);




/*
  var infoLayerWeather = new ol.layer.Image({
    source: new ol.source.ImageWMS({
      url: 'http://mesonet.agron.iastate.edu/cgi-bin/wms/nexrad/n0r.cgi?',
      ratio: 1,
      params: {
          'LAYERS': 'nexrad-n0r-wmst',
          'TRANSPARENT': 'true',
          'FORMAT' : 'image/png'
      }
    })
  });
  map.addLayer(infoLayerNASA);

  var infoLayerNASA = new ol.layer.Image({
    source: new ol.source.ImageWMS({
      url: 'http://wms.jpl.nasa.gov/wms.cgi',
      ratio: 1,
      params: {
          'LAYERS': "modis,global_mosaic",
          'TRANSPARENT': 'true'
      }
    })
  });
  map.addLayer(infoLayerNASA);
*/




//## mapLayerStatensKartverk ######################## //
var mapLayersStatKart = new ol.layer.Group({
  id: "mapLayersStatKart",
  name:"mapLayersStatKart",
  visible: false
});
mapLayers.getLayers().push(mapLayersStatKart);

	//## mapLayerStatensKartverk
	var statKart_scale = [81920000,40960000,20480000,10240000,5120000,2560000,1280000,640000,320000,160000,80000,40000,20000,10000,5000,2500,1250,625,321.3,156.25,78.125];
	var sProjection = 'EPSG:3857',
			projection = ol.proj.get(sProjection),
			projectionExtent = projection.getExtent(),
			size = ol.extent.getWidth(projectionExtent) / 256,
			resolutions = [],
			matrixIds = [];
	for (var z = 0; z < 20; ++z) {//Max 18?
		// generate resolutions and matrixIds arrays for this WMTS
		resolutions[z] = size / Math.pow(2, z);
		matrixIds[z] = sProjection+":"+z;
	}
	var mapLayerStatensKartverk = new ol.layer.Tile({
	  name: "Norges grunnkart",
		title: "Norges grunnkart",
		source: new ol.source.WMTS({
		  url: "http://cache.kartverket.no/grunnkart/wmts?",
		  layer: "norges_grunnkart",
		  matrixSet: sProjection,
		  format: 'image/png',
		  projection: projection,
		  tileGrid: new ol.tilegrid.WMTS({ 
			  origin: ol.extent.getTopLeft(projectionExtent),
			  resolutions: resolutions,
			  matrixIds: matrixIds
		  }),
		  style: 'default'
		})
	})
	mapLayersStatKart.getLayers().push(mapLayerStatensKartverk);

//### mapLayers END ############################################### //
//### mapLayers END ############################################### //







//### infoLayers ############################################### //
var infoLayers = new ol.layer.Group({
  id: "infoLayers",
  name:"infoLayers",
  visible: false,
});
map.addLayer(infoLayers);

	// ## OpenWeatherMap
	API_KEY = "cdf7625e7b6ef02a70b345ba6b090e7e";
 	var infoLayerWeather = new ol.layer.Group({
	  id: "infoLayerWeather",
	  name:"infoLayerWeather",
	visible: true
	});
	infoLayers.getLayers().push(infoLayerWeather);


	    //## infoLayerWeather_precipitation
	    var infoLayerWeather_precipitation = new ol.layer.Tile({
			name: "OWM_Precipitation",
			source: new ol.source.TileWMS({
				url:  'http://wms.openweathermap.org/service',
				projection: projection,
				params: {
					'CRS': 'EPSG:4326',
					'LAYERS': 'precipitation',
					'TRANSPARENT': 'true'
				},
				tileGrid: new ol.tilegrid.TileGrid({ 
					  origin: ol.extent.getTopLeft(projectionExtent),
					  resolutions: resolutions,
					  matrixIds: matrixIds
				})
			})
	    });
	    infoLayerWeather.getLayers().push(infoLayerWeather_precipitation);
/*
	    //## infoLayerWeather_precipitation
	    var infoLayerWeather_precipitation2 = new ol.layer.Tile({
			name: "OWM_Precipitation2",
			projection: 'EPSG:4326',
			source: new ol.source.XYZ({
				projection: 'EPSG:4326',
				url:  'http://${s}.tile.openweathermap.org/map/precipitation/${z}/${x}/${y}.png',
			}),
	    });
	    infoLayerWeather.getLayers().push(infoLayerWeather_precipitation2);
*/
		
//### poiLayers ############################################### //
var poiLayers = new ol.layer.Group({
  id: "poiLayers",
  name:"poiLayers",
  visible: true,
});
map.addLayer(poiLayers);






//### drawLayers ############################################### //
var drawLayers = new ol.layer.Group({
  id: "drawLayers",
  name:"drawLayers",
  visible: false,
});
map.addLayer(drawLayers);







