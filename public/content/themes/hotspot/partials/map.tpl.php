<?php

if(!empty(get_field('latitude'))){
    $latitude = get_field('latitude');
    $longitude = get_field('longitude');
}else{
    $latitude = 51.505;
    $longitude = -0.09;
}  

?>


<div style="height: 480px; background-color: blue;">
    
    <div id="map" style="height: 480px;">
    
    <script>
        window.onload = function(){

            console.log('console de la carte chargée');

            // point sur laquelle la carte s'ouvre
            var map = L.map('map').setView([<?php echo $latitude .','.$longitude ?>], 13);

            var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // marqueur +popup
            var marker = L.marker([<?php echo $latitude .','.$longitude ?>]).addTo(map);
            marker.bindPopup("<b><?php echo get_the_title(); ?></b><br>I am a popup.").openPopup();

            // quand on clique, affiche latitude longitude
            var popup = L.popup();
            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(map);

                
                // LATLONG PICKER

                //1 récup latlong (élément du dom)
                let popupElement = document.querySelector( ".leaflet-popup-content-wrapper .leaflet-popup-content" );
                let popupText = popupElement.innerText;
                    //1.2 isoler latitude et longitude
                    let filtering = popupText.match(/\d|\.|\-/g).join('');
                    console.log(filtering);

                //2 récup inpu
                let longitudeInputElement = document.querySelector( "#longitude" );
                let latitudeInputElement = document.querySelector( "#latitude" );
                //3 mettre latlong dans input (+value)
            
            
                    
            }

            map.on('click', onMapClick);

           
            
        }       
    </script>
    <!-- </div> -->
</div>