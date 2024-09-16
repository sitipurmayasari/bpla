
@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
<script type="text/javascript">
    document.addEventListener("livewire:load", function(event) {
         initMap(); 
    });
  

   function initMap(){
       var points = "";
       var markersLayer = new L.LayerGroup(); 
       var map = L.map('map').setView([{{$lattitude}},{{$longitude}}], 13);
       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       }).addTo(map);

       markersLayer.addTo(map);

       const searchControl = new GeoSearch.GeoSearchControl({
            provider: new GeoSearch.OpenStreetMapProvider(),
            showMarker: false,
            style: "bar",
        });

        map.addControl(searchControl);


        var markerOptions = {
            title: "MyLocation",
            clickable: true,
            draggable: false,
        };
        var marker = L.marker(
            [{{$lattitude}},{{$longitude}}],
            markerOptions
        );
        marker.addTo(map).bindPopup("Pilih Lokasi Ini").openPopup();
        marker.dragging.enable();
        marker.on("dragend", function (e) {
            // document.getElementById("lat").value = marker.getLatLng().lat;
            // document.getElementById("lng").value = marker.getLatLng().lng;
        });
        map.on("geosearch/showlocation", () => {
            if (marker) {
                map.removeControl(marker);
            }
            map.eachLayer((item) => {
            if (item instanceof L.Marker) {
                // Once you found it, set the properties
                item.options.draggable = true;
                item.options.autoPan = true;
                // Then enable the dragging. Without this, it wont work
                item.dragging.enable();
            }
            });
        });

        map.on("click", function (e) {
        var lat = e.latlng.lat;
        var lon = e.latlng.lng;
        if (marker != undefined) {
          map.removeLayer(marker);
        }
        console.log(e);
        marker = L.marker([lat, lon]).addTo(map);
        // selectLocation(lat,lon)
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lon;
        @this.set('lattitude', lat);
        @this.set('longitude', lon);
      });

   }
  

</script>
@endpush
