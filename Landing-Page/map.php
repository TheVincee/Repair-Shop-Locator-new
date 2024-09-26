<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Map.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Locator</span>
    </div>

   <!-- Search Box -->
<<form class="search-box" onsubmit="event.preventDefault(); searchAutoRepairShops();">
  <input id="location" type="text" placeholder="Enter a location">
  <i class="fa fa-search"></i> <!-- Assuming you're using Font Awesome for the icon -->
</form>


    <ul class="nav-links">
      <li>
        <a href="Home.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="Home.php"></a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="NotificationStatus.php">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Category</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="NotificationStatus.php">Category</a></li>
          <li><a href="Appointment-History.php">HTML & CSS</a></li>
          <li><a href="#">JavaScript</a></li>
          <li><a href="#">PHP & MySQL</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Posts</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Posts</a></li>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Login Form</a></li>
          <li><a href="#">Card Design</a></li>
        </ul>
      </li>
      <li>
        <a href="Home.php">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="link_name">Analytics</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="Home.php">Analytics</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Chart</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Chart</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-plug' ></i>
            <span class="link_name">Plugins</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Plugins</a></li>
          <li><a href="#">UI Face</a></li>
          <li><a href="#">Pigments</a></li>
          <li><a href="#">Box Icons</a></li>
        </ul>
      </li>
      <li>
        <a href="NotificationStatus.php">
          <i class='bx bx-compass' ></i>
          <span class="link_name">Explore</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="NotificationStatus.php">Explore</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-history'></i>
          <span class="link_name">History</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">History</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="image/profile.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">Prem Shahi</div>
        <div class="job">Web Desginer</div>
      </div>
      <a href="/Repair-Shop-Locator-new/LOGIN/Sign-in.php" class="logout-link">
    <i class='bx bx-log-out'></i> 
</a>    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>
      <div id="map" class="custom-container"></div>

  </section>

  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
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
        // Clear existing markers
        clearMarkers();
        
        // Set new zoom level
        map.setZoom(15);

        // Update map center to the location of the first result (if any)
        if (results.length > 0) {
            map.setCenter(results[0].geometry.location);
        }

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

  </script>
  <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBskJAbt6y3jJ-cb4IuRumlwCh-NafTn5A&libraries=places&callback=initMap"
        async defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
</body>
</html>
