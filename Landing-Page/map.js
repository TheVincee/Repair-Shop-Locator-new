let map;
let service;
let infowindow;
let markers = [];

function initMap() {
    const mapCenter = { lat: 11.0382, lng: 124.0097 }; // Bogo City, Cebu
    map = new google.maps.Map(document.getElementById("map"), {
        center: mapCenter,
        zoom: 12
    });
    infowindow = new google.maps.InfoWindow();

    // Get the location input field
    const locationInput = document.getElementById("location");

    // Add an event listener for the 'keypress' event
    locationInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            // If Enter key is pressed, trigger the search function
            searchAutoRepairShops();
        }
    });
}

function searchAutoRepairShops() {
    const location = document.getElementById("location").value;
    const request = {
        location: map.getCenter(),
        radius: 6000, // Search radius in meters
        query: `Auto Repair Shop near ${location}`
    };

    service = new google.maps.places.PlacesService(map);
    service.textSearch(request, displayAutoRepairShops);
}

function displayAutoRepairShops(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        map.setZoom(15); // Zoom in when results are displayed
        clearMarkers();
        for (let i = 0; i < results.length; i++) {
            createMarker(results[i]);
        }
    }
}

function createMarker(place) {
    const marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });

    markers.push(marker);

    google.maps.event.addListener(marker, "click", function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
        document.getElementById("selectedShop").innerText = "Selected Auto Repair Shop: " + place.name;
    });
}


function clearMarkers() {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
}

// ... (your existing code) ...


// ... (your existing code) ...
