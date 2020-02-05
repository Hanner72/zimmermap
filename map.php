<!DOCTYPE html >
  <head>
    <meta voller_name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <link type="text/css" href="inc/styles.css" rel="stylesheet">

    <title>WW Strabag - Zimmersuche Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 95%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

<html>
  <body>
    

    <div id="map"></div>
    
    <div><a href="index.php" class="buttonweiss">Zimmerliste</a></div>
    
    <script>
      var customLabel = {
        Hotel: {
          label: 'H'
        },
        Gasthaus: {
          label: 'G'
        },
        Privat: {
          label: 'P'
        }
      };

      var iconBase =
            'icons/';

      var custommarker = {
        Hotel: {
          cmark: iconBase + 'hotel.png'
        },
        Gasthaus: {
          cmark: iconBase + 'gasthaus.png'
        },
        Privat: {
          cmark: iconBase + 'privat.png'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          
          center: new google.maps.LatLng(47.6333198, 12.7986664),
          zoom: 8.25
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('markers.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var voller_name = markerElem.getAttribute('voller_name');
              var addresse = markerElem.getAttribute('addresse');
              var mobil = markerElem.getAttribute('mobil');
              var mail = markerElem.getAttribute('mail');
              var www = markerElem.getAttribute('www');
              var tel = markerElem.getAttribute('tel');
              var kategorie = markerElem.getAttribute('kategorie');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
            
            // Map Marker Popup
              var infowincontent = document.createElement('div');

              var strong = document.createElement('strong');
              strong.textContent = voller_name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = addresse
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));

              var mobil1 = document.createElement('mobil1');
              mobil1.textContent = mobil
              infowincontent.appendChild(mobil1);
              infowincontent.appendChild(document.createElement('br'));

              var telefon = document.createElement('telefon');
              telefon.textContent = tel
              infowincontent.appendChild(telefon);
              infowincontent.appendChild(document.createElement('br'));

              var mail1 = document.createElement('mail1');
              mail1.textContent = mail
              infowincontent.appendChild(mail1);
              infowincontent.appendChild(document.createElement('br'));

              var www1 = document.createElement('a');
              www1.href = www
              www1.textContent = www
              www1.target = '_blank'
              infowincontent.appendChild(www1);

              var icon = customLabel[kategorie] || {};
              var mark = custommarker[kategorie] || {};

              // Create markers.
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
                icon: mark.cmark //Neu hinzugefügt Marker Icons
              });

              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUKiRWWU2Iz8EBxuRt6lCAdJ7J5zL0nww&callback=initMap">
    </script>
  </body>
</html>