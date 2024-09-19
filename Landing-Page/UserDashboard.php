<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="UserDash.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">UserDash</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="map.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="Home.php">Category</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="Home.php">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Category</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Category</a></li>
                    <li><a href="#">HTML & CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">PHP & MySQL</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-book-alt'></i>
                        <span class="link_name">Posts</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Posts</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Login Form</a></li>
                    <li><a href="#">Card Design</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="Home.php">
                    <i class='bx bx-line-chart'></i>
                    <span class="link_name">Chart</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Chart</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-plug'></i>
                        <span class="link_name">Plugins</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Plugins</a></li>
                    <li><a href="#">UI Face</a></li>
                    <li><a href="#">Pigments</a></li>
                    <li><a href="#">Box Icons</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Explore</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Explore</a></li>
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
                    <i class='bx bx-cog'></i>
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
                        <div class="job">Web Designer</div>
                    </div>
<a href="/Repair-Shop-Locator-new/LOGIN/Sign-in.php" class="logout-link">
    <i class='bx bx-log-out'></i> 
</a>                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>
        <!-- Dashboard Section -->
        <section class="dashboard-section">
            <div class="dashboard-content">
                <div class="metrics-boxes">
                    <div class="metric-box">
                        <div class="metric-details">
                            <div class="box-topic">Pending Repairs</div>
                            <div class="number">10,876</div>
                            <div class="indicator">
                                <i class='bx bx-time-five'></i>
                                <span class="text">Up from yesterday</span>
                            </div>
                        </div>
                        <i class='bx bx-wrench cart'></i>
                    </div>
                    <div class="metric-box">
                        <div class="metric-details">
                            <div class="box-topic">Approved Repairs</div>
                            <div class="number">8,876</div>
                            <div class="indicator">
                                <i class='bx bx-check-circle'></i>
                                <span class="text">Up from yesterday</span>
                            </div>
                        </div>
                        <i class='bx bx-like cart'></i>
                    </div>
                    <div class="metric-box">
                        <div class="metric-details">
                            <div class="box-topic">Rejected Repairs</div>
                            <div class="number">1,876</div>
                            <div class="indicator">
                                <i class='bx bx-x-circle'></i>
                                <span class="text">Down from yesterday</span>
                            </div>
                        </div>
                        <i class='bx bx-dislike cart'></i>
                    </div>
                    <div class="metric-box">
                        <div class="metric-details">
                            <div class="box-topic">In-Processing</div>
                            <div class="number">5,876</div>
                            <div class="indicator">
                                <i class='bx bx-cog'></i>
                                <span class="text">Up from yesterday</span>
                            </div>
                        </div>
                        <i class='bx bx-loader-alt cart'></i>
                    </div>
                </div>
            </div>
        </section>
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
</body>
</html>
