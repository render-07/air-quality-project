<?php 
  require_once("login.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Air Quality Monitoring</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="assets/avatar.png" type="image/gif" sizes="16x16" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <section>
      <div class="circle"></div>

      <div class="navigation-bar">
        <div id="navigation-container">
          <img src="assets/logo.png" class=logo>
          <ul>
          <li><a href="http://localhost/air_quality_project/sign-up.php">Create an account</a></li>
          <li><a href="#loginModal" class="trigger-btn" data-toggle="modal">Login</a></li>
          <li>
            <a
              href="https://www.who.int/tools/air-quality-standards"
              target="_bla"
              >WHO</a
            >
          </li>
          </ul>
      </div>

      <div class="content">
        <div class="textBox">
          <h2>
            A breath of Fresh Air <br />
            It's <span> Air Purifier</span>
          </h2>
          <p style="font-weight: 10; text-align: justify">
            This project utilizes different types of filters and a disinfection
            method to ensure that the indoor air was cleaned and safe to breathe
            in. This will help to avoid getting infected by different pollutants
            circulating in the surrounding area. The process involves the use of
            the following: aluminum filter, pre-filter, antimicrobial air
            filter, HEPA filter, photocatalytic filter, negative ion, activated
            carbon filter, and UV light.
          </p>
          <a href="#">Learn More</a>
        </div>
        <div class="imgBox">
          <img src="assets/img1.png" alt="Air purifier" />
        </div>
      </div>
    </section>

    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="contents">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis
              congue est, non cursus nibh. Etiam porttitor augue
            </p>
            <div class="social">
              <a href="#"><span class="fab fa-facebook-f"></span></a>
              <a href="#"><span class="fab fa-twitter"></span></a>
              <a href="#"><span class="fab fa-instagram"></span></a>
            </div>
          </div>
        </div>
        <div class="centered box">
          <h2>Address</h2>
          <div class="contents">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text"
                >Boni Ave, Mandaluyong City, 1550 Metro Manila</span
              >
            </div>
            <div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">+639498152970 </span>
            </div>
            <div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text">airpdco.@gmail.com</span>
            </div>
          </div>
        </div>
        <div class="right box">
          <h2>Contact us</h2>
          <div class="contents">
            <form action="#">
              <div class="email">
                <div class="text">Email *</div>
                <input type="email" required />
              </div>
              <div class="msg">
                <div class="text">Message *</div>
                <textarea rows="2" cols="25" required></textarea>
              </div>
              <div class="btn">
                <button type="submit">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="bottom">
        <center>
          <span class="credit">Created By <a href="#">Air PD Co.</a> | </span>
          <span class="far fa-copyright"></span
          ><span> 2022 All rights reserved.</span>
        </center>
      </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="modal fade">
      <div class="modal-dialog modal-login">
        <div class="modal-content">
          <div class="modal-header">
            <div class="avatar">
              <img src="assets/avatar.png" alt="Avatar">
            </div>				
            <h4 class="modal-title">Admin Login</h4>	
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <form action="login.php" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>		
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>	
              </div>        
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          <p class="signup">Don't have an account ? <a href="http://localhost/air_quality_project/sign-up.php">Sign up</a></p>
          </div>
        </div>
      </div>   
    </body>
</html>
