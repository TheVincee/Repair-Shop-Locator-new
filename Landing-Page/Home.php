<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SpotMechanic</title>
  <link rel="stylesheet" href="CSS/Home.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
  <header class="header">
    <nav class="navbar">
      <h2 class="logo"><a href="#">SpotMechanic</a></h2>
      <input type="checkbox" id="menu-toggle" />
      <label for="menu-toggle" id="hamburger-btn">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
          <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </label>
      <ul class="links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
      <div class="buttons">
        <a href="#" class="signin">Sign In</a>
        <a href="#" class="signup">Sign Up</a>
      </div>
    </nav>
  </header>
  
  <main>
    <section class="hero-section">
      <div class="hero">
        <h2>SpotTheMechanic</h2>
        <p>
          Join us in the exciting world of programming and turn your ideas into
          reality. Unlock the world of endless possibilities - learn to code and
          shape the digital future with us.
        </p>
        <div class="buttons">
          <a href="#" class="join">Join Now</a>
          <a href="#" class="learn">Learn More</a>
        </div>
      </div>
      <div class="img">
        <img src="hero-bg.png" alt="hero image">
      </div>
    </section>
   
    <section class="services-section">
      <div class="container-fluid">
        <h1 class="text-center mt-5 display-3 fw-bold">Our <span class="theme-text">Services</span></h1>
        <hr class="mx-auto mb-5 w-25">
        <div class="row mb-5">
          <div class="col-12 col-sm-6 col-md-3 m-auto">
            <div class="card shadow">
              <img src="images/web.svg" alt="Web Development" class="card-img-top">
              <div class="card-body">
                <h3 class="text-center">Web Development</h3>
                <hr class="mx-auto w-75">
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut eligendi soluta est veniam sequi
                  nemo, quas delectus eveniet ducimus rem animi. Natus non earum deleniti aliquam
                </p>
              </div>
            </div>
          </div>
          <!-- Repeat the card structure for other services -->
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="content">
      <div class="left box">
        <div class="upper">
          <div class="topic">About us</div>
          <p>CodingLab is a channel where you can learn HTML,
          CSS, and also JavaScript along with creative CSS Animations and Effects.</p>
        </div>
        <div class="lower">
          <div class="topic">Contact us</div>
          <div class="phone">
            <a href="#"><i class="fas fa-phone-volume"></i>+007 9089 6767</a>
          </div>
          <div class="email">
            <a href="#"><i class="fas fa-envelope"></i>abc@gmail.com</a>
          </div>
        </div>
      </div>
      <div class="middle box">
        <div class="topic">Our Services</div>
        <div><a href="#">Web Design, Development</a></div>
        <div><a href="#">Web UX Design, Reasearch</a></div>
        <div><a href="#">Web User Interface Design</a></div>
        <div><a href="#">Theme Development, Design</a></div>
        <div><a href="#">Mobile Application Design</a></div>
        <div><a href="#">Wire raming & Prototyping</a></div>
      </div>
      <div class="right box">
        <div class="topic">Subscribe us</div>
        <form action="#">
          <input type="text" placeholder="Enter email address">
          <input type="submit" name="" value="Send">
          <div class="media-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </form>
      </div>
    </div>
    <div class="bottom">
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
