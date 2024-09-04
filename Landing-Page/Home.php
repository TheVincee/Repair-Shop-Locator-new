<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Shop Locator</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        
        <h1 class="sitename">Locate-Mechanic</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="Appointment-table.php">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        
      </nav>
      <form class="d-flex">
      <a href="/Repair-Shop-Locator-new-Shop/LOGIN/Sign-in.php" class="btn btn-outline-danger">Logout</a>
      </form>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
  <div class="carousel-container">
    <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Our Vehicle Repair Locator</span></h2>
    <p class="animate__animated animate__fadeInUp">Find top-rated repair specialists for your car and motorcycle with ease. Our platform connects you with trusted professionals who can address your vehicle's needs efficiently. Explore our features and let us help you keep your vehicle in top shape.</p>
    <a href="map.php" class="btn-get-started animate__animated animate__fadeInUp scrollto">Locate</a>
  </div>
</div>



        
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

  
    <section id="features-2" class="features section features-2">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
    <h2>Features</h2>
    <p>Find reliable vehicle repair services near you with our easy-to-use locator tool.</p>
</div>

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="features-image col-lg-4 d-flex align-items-center" data-aos="fade-up">
            <img src="assets/img/features.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-7 d-flex flex-column justify-content-center">

          <div class="features-item d-flex" data-aos="fade-up" data-aos-delay="200">
  <i class="bi bi-archive flex-shrink-0"></i>
  <div>
  <h4>Wide Range of Repair Services</h4>
<p>Our platform provides access to a broad spectrum of vehicle repair services. Whether you need routine maintenance or urgent repairs, easily connect with local experts who can address your vehicle’s specific needs.</p>

  </div>
</div>
<!-- End Features Item-->

<div class="features-item d-flex mt-5" data-aos="fade-up" data-aos-delay="300">
  <i class="bi bi-basket flex-shrink-0"></i>
  <div>
  <h4>High-Quality Repair Services</h4>
<p>Experience exceptional quality with our carefully vetted repair services. Each provider is selected to ensure top-notch workmanship and reliability, giving you peace of mind for all your vehicle repair needs.</p>
  </div>
</div>

  <div class="features-item d-flex mt-5" data-aos="fade-up" data-aos-delay="400">
    <i class="bi bi-broadcast flex-shrink-0"></i>
    <div>
    <h4>Expert Assistance</h4>
<p>Get professional guidance and support from our network of experienced repair specialists. We offer expert advice and solutions to address all your vehicle concerns quickly and effectively.</p>
    </div>
  </div>


  <div class="features-item d-flex mt-5 " data-aos="fade-up" data-aos-delay="500">
  <i class="bi bi-camera-reels flex-shrink-0"></i>
  <div>
    <h4>Reliable Performance</h4>
    <p>Count on our services for consistent and dependable results. We prioritize efficiency and effectiveness, ensuring that your needs are met with the highest level of reliability.</p>
  </div>
</div>

          </div>
        </div>

      </div>


    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
     <!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Our Services</h2>
  <p>Explore our range of services designed to provide exceptional solutions tailored to your needs. From expert repairs to top-notch customer support, we are committed to delivering excellence.</p>
</div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-activity"></i>
    </div>
    <a href="service-details.html" class="stretched-link">
      <h3>Efficient Solutions</h3>
    </a>
    <p>Discover solutions that enhance efficiency and productivity. Our team is dedicated to delivering results that drive success and innovation.</p>
  </div>
</div><!-- End Service Item -->

<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-broadcast"></i>
    </div>
    <a href="service-details.html" class="stretched-link">
      <h3>Comprehensive Support</h3>
    </a>
    <p>Our comprehensive support services ensure you receive the help you need when you need it. We address your concerns with precision and care.</p>
  </div>
</div><!-- End Service Item -->

<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-easel"></i>
    </div>
    <a href="service-details.html" class="stretched-link">
      <h3>Creative Design</h3>
    </a>
    <p>Our creative design services bring your ideas to life with originality and flair. We craft designs that capture attention and convey your message effectively.</p>
  </div>
</div><!-- End Service Item -->

<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-bounding-box-circles"></i>
    </div>
    <a href="service-details.html" class="stretched-link">
      <h3>Advanced Analytics</h3>
    </a>
    <p>Utilize advanced analytics to gain valuable insights and make data-driven decisions. Our tools and expertise help you understand trends and improve outcomes.</p>
    <a href="service-details.html" class="stretched-link"></a>
  </div>
</div><!-- End Service Item -->

<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-calendar4-week"></i>
    </div>
    <a href="service-details.html" class="stretched-link">
      <h3>Event Management</h3>
    </a>
    <p>Plan and execute memorable events with our professional event management services. We handle all the details to ensure a seamless and successful experience.</p>
    <a href="service-details.html" class="stretched-link"></a>
  </div>
</div><!-- End Service Item -->

<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
  <div class="service-item position-relative">
    <div class="icon">
      <i class="bi bi-chat-square-text"></i>
    </div>
    <a href="service-details.html" class="stretched-link">
      <h3>Customer Engagement</h3>
    </a>
    <p>Enhance customer relationships with our engagement strategies. We help you connect with your audience and build lasting, meaningful interactions.</p>
    <a href="service-details.html" class="stretched-link"></a>
  </div>
</div><!-- End Service Item -->
<!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Faq Section -->
<!-- Faq Section -->
<section id="faq" class="faq section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Frequently Asked Questions</h2>
    <p>Find answers to the most common questions about our repair shop locator and services.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

        <div class="faq-container">
        <div class="faq-item faq-active">
  <h3>What types of repair services are available through your locator?</h3>
  <div class="faq-content">
    <p>Our locator provides access to a variety of repair services including electronics, automobiles, home appliances, plumbing, and more. You can easily search for specialists who are equipped to handle your specific repair needs in your area.</p>
  </div>
  <i class="faq-toggle bi bi-chevron-right"></i>
</div>

          <div class="faq-item">
            <h3>How do I find a repair shop near me?</h3>
            <div class="faq-content">
              <p>Use our search tool to enter your location or enable GPS. This will show you a list of repair shops in your area along with their contact details and reviews.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->

          <div class="faq-item">
            <h3>Can I read reviews about the repair shops?</h3>
            <div class="faq-content">
              <p>Yes, our platform includes customer reviews and ratings for many repair shops. You can read these reviews to make an informed decision about which repair shop to choose.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->

          <div class="faq-item">
            <h3>How do I book a repair service?</h3>
            <div class="faq-content">
              <p>After finding a repair shop, you can book a service directly through their contact information or website. Some shops offer online booking options through our platform.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->

          <div class="faq-item">
            <h3>What if I need to cancel or reschedule my appointment?</h3>
            <div class="faq-content">
              <p>Contact the repair shop directly to cancel or reschedule your appointment. Be sure to check their cancellation policy for any potential fees or time restrictions.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->

          <div class="faq-item">
            <h3>Can I get a quote before booking a service?</h3>
            <div class="faq-content">
              <p>Many repair shops provide quotes or estimates based on your description of the problem. You can contact them directly through our platform to request a quote before booking the service.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
          </div><!-- End Faq item-->

        </div>

      </div>

    </div>


</section><!-- End Faq Section -->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
  <h2>Contact Us</h2>
  <p>Get in touch with us for any inquiries or support related to vehicle repair services. We're here to assist you with all your needs.</p>
</div>
<!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">
  <div class="container">
    <h3 class="sitename">RepairLocator</h3>
    <p>Your go-to source for finding trusted repair services for cars, motorcycles, and more. We're dedicated to helping you find the right specialist for your vehicle's needs.</p>
    <div class="social-links d-flex justify-content-center">
      <a href=""><i class="bi bi-twitter"></i></a>
      <a href=""><i class="bi bi-facebook"></i></a>
      <a href=""><i class="bi bi-instagram"></i></a>
      <a href=""><i class="bi bi-skype"></i></a>
      <a href=""><i class="bi bi-linkedin"></i></a>
    </div>
    <div class="container">
      <div class="copyright">
        <span>Copyright</span> <strong class="px-1 sitename">RepairLocator</strong> <span>All Rights Reserved</span>
      </div>
    </div>
  </div>
</footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>