// OpenLayers start
// Litt norgeskart voodoo
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
	
// Sveiv i gang openlayers
var map = new ol.Map({
  target: "mapDiv",
  controls: [],
  layers: [
	new ol.layer.Tile({
	  source: new ol.source.OSM(),
	  opacity: 0.4
	}),
	new ol.layer.Tile({
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
  ],
  view: new ol.View({
			projection: projection,
			scale: statKart_scale,
			center: [1572378.549806288, 9963627.597984985],
			zoom: 10
		})
})
