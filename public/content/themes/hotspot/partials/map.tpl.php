
<div style="height: 480px; background-color: blue;">
    
    <div id="map" style="height: 480px;">
    
    <script>
        window.onload = function(){

            console.log('console de la carte chargée');

            // point sur laquelle la carte s'ouvre
            var map = L.map('map').setView([51.505, -0.09], 13);

            var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // marqueur +popup
            var marker = L.marker([51.5, -0.09]).addTo(map);
            marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

            // quand on clique, affiche latitude longitude
            var popup = L.popup();

            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(map);
            }

            map.on('click', onMapClick);
        }       
    </script>