<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>LE9KO - MobileTracker</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
  </head>
  <body>

<!--
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
-->

<!--
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>MERK!</strong> Du må trykke start sporing!
    </div>
-->

  <div class="container">
    <br />
    <form class="form">
      <div class="form-group">
        <div class="input-group input-group-lg">
          <div id="showCall" class="input-group-addon"><?php !empty($_GET['Callsign'])  ? print($_GET["Callsign"]): print("[Callsign]"); ?></div>
          <input type="text" class="form-control" id="PIN" placeholder="PIN" <?php if(!empty($_GET['PIN'])) echo 'value="'.$_GET['PIN'].'"'; ?> />
        </div>
      </div>
      <div class="button-group">
        <button type="button" class="btn btn-success btn-lg" id="geoToggle" >Start sporing</button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Settings">Innstillinger</button>
      </div>
    </form>
	</div>

<!-- Modal med instillinger -->
<div class="modal fade" id="Settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Innstillinger</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="Callsign">Callsign:</label>
            <input type="text" class="form-control" id="Callsign" placeholder="Callsign" <?php if(!empty($_GET['Callsign'])) echo 'value="'.$_GET['Callsign'].'"'; ?> />
          </div>
          <div class="form-group">
            <label for="Interval">Send pos:</label>
            <select class="form-control" id="Interval">
              <option value="1">1 min</option>
              <option value="2">2 min</option>
              <option value="5">5 min</option>
              <option value="10">10 min</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Lukk</button>
      </div>
    </div>
  </div>
</div>

	<script type="text/javascript" src="/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script>
 
  // Vars
  var CALLSIGN = <?php !empty($_GET['Callsign'])  ? print('"'.$_GET["Callsign"].'"'): print("\"\""); ?> ;
  var PINCODE  = <?php !empty($_GET['PIN'])       ? print('"'.$_GET["PIN"].'"')     : print("\"\""); ?> ;
  var INTERVAL = 1;
  var geoID;

  // SporingsInnstillinger
  var le9mobil_geoSettings = {
    enableHighAccuracy: true,
    timeout: 1000,
    maximumAge: 1000
  };


  // Oppdater vars
  $('input[id=Callsign]').change(function() {
    CALLSIGN = $('input[id=Callsign]').val();
    $('#showCall').text(CALLSIGN);
  });
  $('input[id=PIN]').change(function() {
    PINCODE = $('input[id=Callsign]').val();
  });

  $('input[id=Interval]').change(function() {
    geoSettings.Interval = $('input[id=Interval]').val();
  });



  /*
    Eventhandler for Sporingsknappen
  */
  $('#geoToggle').on('click', function () {

    // Start med å gjøre knappen gul og endre text
    $(this).removeClass("btn-success");
    $(this).removeClass("btn-warning");
    $(this).removeClass("btn-danger");
    $(this).addClass("btn-warning");
    $(this).text("Starter..");
    
    // Kjører sporingen?
    if(geoID) {
      navigator.geolocation.clearWatch(geoID);
      geoID = false;
      $(this).removeClass("btn-warning").addClass("btn-success");
      $(this).text("Start sporing");
      console.log("Sporingen er stoppet!");
    } else {

      // Callsign er obligatorisk lag noe om det ikke er satt
      if(!CALLSIGN) {
        CALLSIGN = "Apekatt";
        $('#showCall').text(CALLSIGN);
      }
      
      // PIN kreves for SAR (for å legges i rett ressursgruppe), men er ellers ikke obligatorisk?
      if(!PINCODE) {}

      if ("geolocation" in navigator) { // navigator && navigator.geolocation
        geoID = navigator.geolocation.watchPosition(le9mobil_track, errorCallback, le9mobil_geoSettings);
        console.log("Sporingen er startet! ("+geoID+")");
      } else {
        console.log('Geolocation is not supported');
        $(this).removeClass("btn-warning").addClass("btn-info");
        $(this).text("Enheten kan ikke spores!");
      }

      $(this).removeClass("btn-warning").addClass("btn-danger");
      $(this).text("Stop sporing");
    }
  })

 /*
  Halvhjertet forsøk på å bry seg om error's
 */
	function errorCallback() {
    alert('code: ' + error.code + '\n' +
        'message: ' + error.message + '\n');
	}
 
 
 /*
  Samler data og sender til server via REST
 */
	function le9mobil_track(position) {
  // Obl
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var accuracy  = position.coords.accuracy;
    var timestamp = position.timestamp;
  // Fri
    var altitude  = position.coords.altitude;
    var altitudeA = position.coords.altitudeAccuracy;
    var heading   = position.coords.heading;
    var speed     = position.coords.speed;

    // Send posit
    $.get("http://hhovde.dev.hamlabs.no/api/tracker/mobil/"+
      "?call="    + CALLSIGN  +
      "&pin="     + PINCODE   +
      "&lat="     + latitude  +
      "&lon="     + longitude +
      "&acc="     + accuracy  +
      "&time="    + timestamp +
      "&alt="     + altitude  +
      "&alta="    + altitudeA +
      "&heading=" + heading   +
      "&speed="   + speed 
    );

    // Debug logger
		// console.log(position);
	}
	
	</script>
  </body>
</html>
