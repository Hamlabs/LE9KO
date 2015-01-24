﻿<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>LE9KO</title>

    <link rel="stylesheet" href="/css/ol.css" />
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/koass_webui.css" />

  </head>
  <body>
    <div class="container">
	</div>
      <div id="mapDiv">
      </div>
      <div class="row main-row">
        <div class="col-sm-4 col-md-3 sidebar sidebar-left pull-left">
          <div class="panel-group sidebar-body" id="accordion-left">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#layers">
                    <i class="fa fa-globe"></i>
                    Verktøy
                  </a>
                  <span class="pull-right slide-submenu">
                    <i class="fa fa-chevron-left"></i>
                  </span>
                </h4>
              </div>
				<div id="layers" class="panel-collapse collapse in">
					<p class="panel-body">
					  <a href="#"><i class="fa fa-cogs"></i></a>
					  <a href="#"><i class="fa fa-user"></i></a>
					  <a href="#"><i class="fa fa-sign-out"></i></a>
					</p>
					<p class="panel-body">
					  <a href="#"><i class="fa fa-bell-slash-o"></i></a>
					  <a href="#"><i class="fa fa-bell-o"></i></a>
					  <a href="#"><i class="fa fa-filter"></i></a>
					  <a href="#"><i class="fa fa-flag"></i></a>
					  <a href="#"><i class="fa fa-home"></i></a>
					  <a href="#"><i class="fa fa-info-circle"></i></a>
					  <a href="#"><i class="fa fa-male"></i></a>
					  <a href="#"><i class="fa fa-female"></i></a>
					  <a href="#"><i class="fa fa-paw"></i></a>
					  <a href="#"><i class="fa fa-question-circle"></i></a>
					  <a href="#"><i class="fa fa-search-minus"></i></a>
					  <a href="#"><i class="fa fa-search-plus"></i></a>
					  <a href="#"><i class="fa fa-upload"></i></a>
					  <a href="#"><i class="fa fa-download"></i></a>
					  <a href="#"><i class="fa fa-tag"></i></a>
					  <a href="#"><i class="fa fa-sort-amount-asc"></i></a>
					  <a href="#"><i class="fa fa-sort-amount-desc"></i></a>
					  <a href="#"><i class="fa fa-sort-numeric-asc"></i></a>
					  <a href="#"><i class="fa fa-sort-numeric-desc"></i></a>
					  <a href="#"><i class="fa fa-signal"></i></a>
					  <a href="#"><i class="fa fa-shield"></i></a>
					  <a href="#"><i class="fa fa-puzzle-piece"></i></a>
					  <a href="#"><i class="fa fa-phone"></i></a>
					  <a href="#"><i class="fa fa-pencil"></i></a>
					  <a href="#"><i class="fa fa-paint-brush"></i></a>
					  <a href="#"><i class="fa fa-map-marker"></i></a>
					  <a href="#"><i class="fa fa-eye-dropper"></i></a>
					  <a href="#"><i class="fa fa-binoculars"></i></a>
					  <a href="#"><i class="fa fa-bullseye"></i></a>
					  <a href="#"><i class="fa fa-child"></i></a>
					  <a href="#"><i class="fa fa-cubes"></i></a>
					  <a href="#"><i class="fa fa-desktop"></i></a>
					  <a href="#"><i class="fa fa-unlock"></i></a>
					  <a href="#"><i class="fa fa-lock"></i></a>
					  <a href="#"><i class="fa fa-wrench"></i></a>
					</p>
					<p>
					  <div class="form-group">
					    <div class="checkbox">
                <label class="checkbox" for="sporMeg">
                  <input type="checkbox" id="sporMeg" />Vis min posisjon
                </label>
              </div>
            </div>
					</p>
					  <div class="btn-group" role="group" aria-label="...">
					    <button type="button" class="btn btn-default" id="fly-til-mo">Mo i Rana</button>
					    <button type="button" class="btn btn-default" id="fly-til-harstad">Harstad</button>
            </div>
					  <div class="btn-group" role="group" aria-label="VektorTegning">
					    <button type="button" class="btn btn-warning" id="tegnPunkt">Punkt</button>
					    <button type="button" class="btn btn-warning" id="tegnLinje">Strek</button>
					    <button type="button" class="btn btn-warning" id="tegnPoly">Figur</button>
            </div>
					</p>
					<p>
						<form class="panel-heading" role="search">
						  <div class="form-group">
							<input type="text" class="form-control" placeholder="Søk..">
						  </div>
						</form>
					</p>
				</div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#properties">
                    <i class="fa fa-list-alt"></i>
                    Detaljer:
                  </a>
                </h4>
              </div>
              <div id="properties" class="panel-collapse collapse in">
				<div class="panel-body list-group">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-circle"></i> Lat/Long: 
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-circle"></i> UTM / MGRS
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-circle"></i> Høyde
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-circle"></i> Nærmeste POI
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-6 mid"></div>
        <div class="col-sm-4 col-md-3 sidebar sidebar-right pull-right">
          <div class="panel-group sidebar-body" id="accordion-right">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#taskpane">
                    <i class="fa fa-comment"></i>
                    Kommunikasjon
                  </a>
                  <span class="pull-right slide-submenu">
                    <i class="fa fa-chevron-right"></i>
                  </span>
                </h4>
              </div>
              <div id="taskpane" class="panel-collapse collapse in">
                <div class="panel-body">
				  <p><strong>PopUp:</strong><br/>
					<i class="fa fa-check-square-o"></i>System&nbsp;&nbsp;
					<i class="fa fa-check-square-o"></i>Hendelse&nbsp;&nbsp;
					<i class="fa fa-check-square-o"></i>Samband
				  </p>
				  <p><strong>Historikk:</strong><br/>
					<i class="fa fa-check-square-o"></i>System&nbsp;&nbsp;
					<i class="fa fa-check-square-o"></i>Hendelse&nbsp;&nbsp;
					<i class="fa fa-check-square-o"></i>Samband
				  </p>
				  <hr>
                  <p><strong>2015-01-19 16:08:</strong><br />
                  Mottatt nødmelding fra MS Forlis
                  </p>
                  <p><strong>2015-01-19 16:10:</strong><br />
                  Røde Kors ankommet med 12 pax
                  </p>
                  <p><strong>2015-01-19 16:12:</strong><br />
                  Røde Kors opprettet KO og startet søk med MS RanaRescue
                  </p>
                  <p><strong>2015-01-19 22:16:</strong><br />
                  Sivilforsvaret har gått seg bort å trenger hjelp
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mini-submenu mini-submenu-left pull-left">
        <i class="fa fa-globe"></i>
      </div>
      <div class="mini-submenu mini-submenu-right pull-right">
        <i class="fa fa-comment"></i>
      </div>
    </div>



	<script type="text/javascript" src="/js/ol.js" /></script>
	<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/jquery.websocket.js"></script>
	<script type="text/javascript" src="/js/jquery.mqsocket.js"></script>
	<script type="text/javascript" src="/js/jquery.md5.js"></script>
	<script type="text/javascript" src="/js/sprintf.min.js"></script>
	<script type="text/javascript" src="/js/koass_webui.js"></script>
	<script type="text/javascript" src="/js/koass_haversine.js"></script>
	<script type="text/javascript" src="/js/koass_openlayers3.js"></script>
	<script type="text/javascript" src="/js/koass_ol3_tmp.js"></script>
	<script type="text/javascript" src="/js/koass_iconSets.js"></script>
	<script type="text/javascript" src="/js/koass_aprsSymbols.js"></script>
    <script type="text/javascript">
	//#########################################################################
	// Debugging
	map.on('click', function(evt) {
	  var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
	  var lon = lonlat[0];
	  var lat = lonlat[1];

	  console.log("Lat:"+lat+" Lon:"+lon);
	  console.log("Org:"+evt.coordinate);
	  //console.log("X:"map.getView().getCenter().toString());
	});		
	//#########################################################################
 
/*
          // Crate a style instance given feature's properties name and radius.
            function computeFeatureStyle(feature) {
                return new ol.style.Style({
                    image: new ol.style.Circle({
                        radius: feature.get('radius'),
                        fill: new ol.style.Fill({
                            color: 'rgba(100,50,200,0.5)'
                        }),
                        stroke: new ol.style.Stroke({
                            color: 'rgba(120,30,100,0.8)',
                            width: 3
                        })
                    }),
                    text: new ol.style.Text({
                        font: '12px helvetica,sans-serif',
                        text: feature.get('name'),
                        rotation: 360 * rnd * Math.PI / 180,
                        fill: new ol.style.Fill({
                            color: '#000'
                        }),
                        stroke: new ol.style.Stroke({
                            color: '#fff',
                            width: 2
                        })
                    })
                });
            }
*/

    var aprsSource = new ol.source.Vector({
		name: "aprsSource",
//		features: features
    });
    var APRSfi = new ol.layer.Vector({
      source: aprsSource
   });
    map.addLayer(APRSfi);

	// Oppdater vektorlag med posisjoner

	function getLayerDataAPRS(evt) {
		// Jøgle koordinater
		koass_mapBoxCoords	= map.getView().calculateExtent( map.getSize() );
		koass_mapBoxLL1		= ol.proj.transform([koass_mapBoxCoords[0],koass_mapBoxCoords[1]], 'EPSG:3857', 'EPSG:4326');
		koass_mapBoxLL2		= ol.proj.transform([koass_mapBoxCoords[2],koass_mapBoxCoords[3]], 'EPSG:3857', 'EPSG:4326');
		koass_mapCenterLL 	= ol.proj.transform(map.getView().getCenter(), 'EPSG:3857', 'EPSG:4326');
		var koass_viewPortDist	= koass_getDistance(koass_mapBoxLL1, koass_mapBoxLL2,"km",true); 

		//$.getJSON('http://hhovde.dev.hamlabs.no/api/geo/radius/?lat=66.30&lon=14.10&radius=50&minutes=60&format=json', function (APRSdata) {
		$.getJSON('http://hhovde.dev.hamlabs.no/api/geo/radius/?lon='+koass_mapCenterLL[0]+'&lat='+koass_mapCenterLL[1]+'&radius='+Math.round(koass_viewPortDist/2)+'&minutes=60&history=yes&format=json', function (APRSdata) {
		var features = [];
		var counter = 0;  
		
		$.each(APRSdata, function(aprsCALL, value) {
		
			counter = counter+1; // Denne skal fjernes etter endt utvikling
			var aprsSymbolToken = value[0].symboltable+value[0].symbolcode;
			
			aprsPos =   ol.proj.transform([value[0].geo_location[0], value[0].geo_location[1]], 'EPSG:4326', 'EPSG:3857');
			geometry =  new ol.geom.Point([aprsPos[0],aprsPos[1]]);
			feature =   new ol.Feature({
				id: $.md5(aprsCALL),
				geometry: geometry,
				properties: {
					id: "test",
					label: aprsCALL,
					name: aprsCALL,
					icon: aprsSymbolToken,
//					description: koass_aprsSymbols.symbols[aprsSymbolToken].description
				}
			});
			feature.setStyle(
				new ol.style.Style({
					image: koass_aprsIcons[0],
					text: new ol.style.Text({
						font: '12px helvetica,sans-serif',
						text: aprsCALL,
						rotation: 0,
						fill: new ol.style.Fill({
							color: '#000'
						}),
						stroke: new ol.style.Stroke({
							color: '#fff',
							width: 2
						}),
						offsetY: 20
					})
				})
			);
			
			console.log(counter+" / "+Object.keys(APRSdata).length +"("+aprsSymbolToken+")"); // Denne skal fjernes etter endt utvikling
			aprsSource.addFeature(feature);
		});
	  });
	}
	map.on('moveend', getLayerDataAPRS);
 	</script>
	</body>
</html>
