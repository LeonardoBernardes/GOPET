
<?php 

/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 18:10:34 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:54:09
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&callback=initMap" async defer></script>

  </body>
</html>