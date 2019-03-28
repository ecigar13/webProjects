
<?php
$apiKey = "AIzaSyBi_JTzVqM5i25N6YLkEnn81lCxKj2BtdQ";
$address = "https://maps.googleapis.com/maps/api/geocode/json?address=";
?>

<link rel="stylesheet" type="text/css" href="index.css">
<script type="text/javascript" src="index.js"></script>
<div id="floating-panel"> 
  <input id="address" type="textbox" value="Plano, TX"> <input id="submit" type="button" value="Geocode"> 
</div>
<div id="map"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi_JTzVqM5i25N6YLkEnn81lCxKj2BtdQ&callback=initMap&libraries=places"
async defer></script>
