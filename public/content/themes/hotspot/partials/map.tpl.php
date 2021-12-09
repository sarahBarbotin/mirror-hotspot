<?php

$fields = get_fields();

dump($fields);
// dump(get_field('city'))

if(!empty($fields['latitude'])){
    $latitude = $fields['latitude'];
    $longitude = $fields['longitude'];
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

                    //quand on clique, affiche en console les coordonnées du clic
                    // console.log(e.latlng);
            }

            map.on('click', onMapClick);

            // LATLONG PICKER

            //1 récup latlong (élément du dom)
                //1.2 isoler latitude et longitude
            //2 récup inpu
            //3 mettre latlong dans input (+value)
        }       
    </script>
    <!-- </div> -->
</div>