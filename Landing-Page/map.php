<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map-container {
            position: relative;
            height: calc(50vh - 56px); /* 50% of viewport height minus navbar height */
            margin-top: 56px; /* Height of the navbar */
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .custom-container {
            background-color: #f8f9fa; /* Light gray background */
            padding: 20px;
            margin: 20px auto;
            border: 1px solid #dee2e6; /* Light gray border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
      <form class="form-inline ml-auto" onsubmit="event.preventDefault(); searchAutoRepairShops();">
        <input class="form-control mr-sm-2" id="location" type="search" placeholder="Enter a location" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
</nav>

<div id="map" class="custom-container"></div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="map.js"></script>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBskJAbt6y3jJ-cb4IuRumlwCh-NafTn5A&libraries=places&callback=initMap"
        async defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>

</body>
</html>
