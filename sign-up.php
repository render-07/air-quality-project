<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Air Quality Monitoring</title>
    <link rel="stylesheet" href="css/signUp.css" />
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
          <li><a href="http://localhost/Website/index.php">Go back</a></li>
          </ul>
      </div>

      <div class="container">
          <div class="user singinBx">
            <div class="formBx">
                <form name = "addUser" action="signUp.php" method="POST">
                    <h2>Sign Up</h2>          
                    <?php
                      $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                      if (strpos($url, "signup_status=successfully_signed_up") == true) {
                        echo "<p class='success'>User created</p>";
                      }  
                      
                      if (strpos($url, "signup_status=password_does_not_match") == true) {
                        echo "<p class='error'>Passwords do not match</p>";
                      }  

                      if (strpos($url, "signup_status=error") == true) {
                        echo "<p class='error'>Something went wrong</p>";
                      }  
                    ?>
                    <input type="text" name="firstname" placeholder="Firstname" required>
                    <input type="text" name="lastname" placeholder="Lastname" required>
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmPassword" placeholder="Confirm password" required>
                    <input type="Submit" name="" value="Sign Up">
                    <p class="signup">Already have an account? <a href="http://localhost/Website/index.php">Log in</a></p>
                </form>
            </div>
            <div class="imgBx"><img src="assets/splash.png" width="400px" height="400px" alt=""></div>
        </div>
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
    </body>
</html>
