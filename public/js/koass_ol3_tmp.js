//#########################################################################
// GeoJSON
  var styleCache = {};
  var koass_geoJSON = new ol.layer.Vector({
      name : "koass_geoJSON",
      source : new ol.source.GeoJSON({
		    projection : 'EPSG:3857',
		    url : 'geo.json'
  	  }),
  	  style : function(feature, resolution) {
		    var text = resolution < 1000 ? feature.get('id') : '';
		    if (!styleCache[text]) {
			    styleCache[text] = [new ol.style.Style({
				    fill : new ol.style.Fill({
					    color : 'rgba(255, 255, 255, 0.1)'
				    }),
				    stroke : new ol.style.Stroke({
					    color : '#319FD3',
					    width : 1
				    }),
				    text : new ol.style.Text({
					    font : '12px Calibri,sans-serif',
					    text : text,
					    fill : new ol.style.Fill({
						    color : '#000'
					    }),
					    stroke : new ol.style.Stroke({
						    color : '#fff',
						    width : 3
					    })
				    }),
            image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
              scale: 0.15,
              anchor: [0.5, 0.5],
              anchorXUnits: 'fraction',
              anchorYUnits: 'fraction',
              opacity: 0.65,
              src: '/img/house-2.png'
            })),
      			zIndex : 999
			    })];
		    }
		    return styleCache[text];
	  }
  });
	poiLayers.getLayers().push(koass_geoJSON);
	

//#########################################################################
// Hopp i kartet
var Harstad = ol.proj.transform([16.53202567, 68.80545713], 'EPSG:4326', 'EPSG:3857');
var flyTilHarstad = document.getElementById('fly-til-harstad');
flyTilHarstad.addEventListener('click', function() {
	var duration = 2000;
    var start = +new Date();
    var pan = ol.animation.pan({
		duration: duration,
		source: /** @type {ol.Coordinate} */ (map.getView().getCenter()),
		start: start
    });
    var bounce = ol.animation.bounce({
		duration: duration,
		resolution: 4 * map.getView().getResolution(),
		start: start
    });
    map.beforeRender(pan, bounce);
    map.getView().setCenter(Harstad);
}, false);


var MoiRana = [1572378.549806288, 9963627.597984985];
var flyTilMo = document.getElementById('fly-til-mo');
flyTilMo.addEventListener('click', function() {
    var duration = 2000;
    var start = +new Date();
    var pan = ol.animation.pan({
		duration: duration,
		source: /** @type {ol.Coordinate} */ (map.getView().getCenter()),
		start: start
    });
    var bounce = ol.animation.bounce({
		duration: duration,
		resolution: 4 * map.getView().getResolution(),
		start: start
    });
    map.beforeRender(pan, bounce);
    map.getView().setCenter(MoiRana);
}, false);



        



//#########################################################################
//Drawing
 var source = new ol.source.Vector();
  var vector = new ol.layer.Vector({
    name: "koass_Vector",
    layerGroup: "poiLayers",
    source: source,
    style: new ol.style.Style({
      fill: new ol.style.Fill({
        color: 'rgba(255, 255, 255, 0.2)'
      }),
      stroke: new ol.style.Stroke({
        color: '#ffcc33',
        width: 2
      }),
      image: new ol.style.Circle({
        radius: 7,
        fill: new ol.style.Fill({
          color: '#ffcc33'
        })
      })
    })
  });
  drawLayers.getLayers().push(vector);

  var draw; // global so we can remove it later
  document.getElementById('tegnPunkt').addEventListener('click', function() {
    addInteraction('Point')
  }, false);
  document.getElementById('tegnLinje').addEventListener('click', function() {
    addInteraction('LineString')
  }, false);
  document.getElementById('tegnPoly').addEventListener('click', function() {
    addInteraction('Polygon')
  }, false);

 function addInteraction(value) {
  //var value = 'Point';
  if (value !== 'None') {
    draw = new ol.interaction.Draw({
      source: source,
      type: /** @type {ol.geom.GeometryType} */ (value)
    });
    map.addInteraction(draw);
  }
}  

//#########################################################################
//GeoLoction
  var geolocation = new ol.Geolocation({
    projection: map.getView().getProjection()
  });

  var track = new ol.dom.Input(document.getElementById('sporMeg'));
  track.bindTo('checked', geolocation, 'tracking');

 // handle geolocation error.
  geolocation.on('error', function(error) {
    console.log("GeoLocErr: "+error.message);
  });

  var accuracyFeature = new ol.Feature();
  accuracyFeature.bindTo('geometry', geolocation, 'accuracyGeometry');

  var positionFeature = new ol.Feature();
  positionFeature.setStyle(new ol.style.Style({
    image: new ol.style.Circle({
      radius: 6,
      fill: new ol.style.Fill({
        color: '#3399CC'
      }),
      stroke: new ol.style.Stroke({
        color: '#fff',
        width: 2
      })
    })
  }));

  positionFeature.bindTo('geometry', geolocation, 'position')
      .transform(function() {}, function(coordinates) {
        return coordinates ? new ol.geom.Point(coordinates) : null;
      });

  var featuresOverlay = new ol.FeatureOverlay({
    map: map,
    features: [accuracyFeature, positionFeature]
  });
  

//#########################################################################
//mapLayerControl

  // Name the root layer group
  map.getLayerGroup().set('name', 'Root');

  /**
   * Build a tree layer from the map layers with visible and opacity 
   * options.
   * 
   * @param {type} layer
   * @returns {String}
   */
  function buildLayerTree(layer) {
      var elem;
      var name = layer.get('name') ? layer.get('name') : "Group";
	  var visi = layer.get('visible') ? "<i class='glyphicon glyphicon-check'></i> " : "<i class='glyphicon glyphicon-unchecked'></i> ";
      var div = "<li data-layerid='" + name + "'>" +
              "<span><i class='glyphicon glyphicon-file'></i> " + layer.get('name') + "</span>" +
              visi +
              "<input style='width:80px;' class='opacity' type='text' value='' data-slider-min='0' data-slider-max='1' data-slider-step='0.1' data-slider-tooltip='hide'></input>";
      if (layer.getLayers) {
          var sublayersElem = ''; 
          var layers = layer.getLayers().getArray(),
                  len = layers.length;
          for (var i = len - 1; i >= 0; i--) {
              sublayersElem += buildLayerTree(layers[i]);
          }
          elem = div + " <ul>" + sublayersElem + "</ul></li>";
      } else {
          elem = div + " </li>";
      }
      return elem;
  }

  /**
   * Initialize the tree from the map layers
   * @returns {undefined}
   */
  function initializeTree() {

      var elem = buildLayerTree(map.getLayerGroup());
      $('#layertree').empty().append(elem);

      $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
      $('.tree li.parent_li > span').on('click', function(e) {
          var children = $(this).parent('li.parent_li').find(' > ul > li');
          if (children.is(":visible")) {
              children.hide('fast');
              $(this).attr('title', 'Expand this branch').find(' > i').addClass('glyphicon-plus').removeClass('glyphicon-minus');
          } else {
              children.show('fast');
              $(this).attr('title', 'Collapse this branch').find(' > i').addClass('glyphicon-minus').removeClass('glyphicon-plus');
          }
          e.stopPropagation();
      });
  }

  /**
   * Finds recursively the layer with the specified key and value.
   * @param {ol.layer.Base} layer
   * @param {String} key
   * @param {any} value
   * @returns {ol.layer.Base}
   */
  function findBy(layer, key, value) {

      if (layer.get(key) === value) {
          return layer;
      }

      // Find recursively if it is a group
      if (layer.getLayers) {
          var layers = layer.getLayers().getArray(),
                  len = layers.length, result;
          for (var i = 0; i < len; i++) {
              result = findBy(layers[i], key, value);
              if (result) {
                  return result;
              }
          }
      }

      return null;
  }


  
//#########################################################################
//Full Screen
//var myFullScreenControl = new ol.control.FullScreen();
//map.addControl(myFullScreenControl);
