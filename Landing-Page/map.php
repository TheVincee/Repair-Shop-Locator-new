<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Shop Locator</title>
    <link rel="stylesheet" href="Map.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- Navbar with Back Icon and Search Bar -->
<nav class="navbar navbar-light bg-light">
    <a href="Home.php" onclick="history.back();" class="navbar-brand">
        <i class='bx bx-arrow-back'></i>
    </a>
    <form class="form-inline ml-auto d-flex align-items-center" onsubmit="event.preventDefault(); searchAutoRepairShops();">
        <input class="form-control mr-2" id="location" type="search" placeholder="Enter a location" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</nav>

<div id="map" class="custom-container"></div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBskJAbt6y3jJ-cb4IuRumlwCh-NafTn5A&libraries=places&callback=initMap" async defer></script>

<!-- Custom JavaScript for the map -->
<script>
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

    // Add event listener to the location input field
    const locationInput = document.getElementById("location");
    locationInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent the form from submitting
            searchAutoRepairShops(); // Trigger the search function
        }
    });
}

function searchAutoRepairShops() {
    const location = document.getElementById("location").value;

    if (!location) {
        alert("Please enter a location.");
        return;
    }

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
        if (results.length > 0) {
            // Center the map on the first result
            map.setCenter(results[0].geometry.location);
            map.setZoom(15); // Zoom in when results are displayed
        }
        
        clearMarkers();
        for (let i = 0; i < results.length; i++) {
            createMarker(results[i]);
        }
    } else {
        alert("No results found or an error occurred: " + status);
        console.error("Google Places Service Status: ", status);
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

document.addEventListener("DOMContentLoaded", initMap);
</script>

</body>
</html>
