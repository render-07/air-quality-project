<?php
  require_once 'login.php';
  include('connectionToDb.php');

  if (!$_SESSION['is_logged']) {
    header("location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProFile Air Purifier</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/pstyle.css" />
    <link rel="icon" href="assets/avatar.png" type="image/gif" sizes="16x16" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <aside>
        <div class="top">
          <div class="logo">
            <img src="assets/logo.png" />
            <h2>Air <span class="logo-color">PD</span> Corp.</h2>
          </div>
          <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
          </div>
        </div>

        <div class="sidebar">
          <a href="http://localhost/Website/dashboard.php">
            <span class="material-icons-sharp">grid_view</span>
            <h3>Dashboard</h3>
          </a>
          <a href="" class="active">
            <span class="material-icons-sharp">people_alt</span>
            <h3>About Us</h3>
          </a>
          <a href="logout.php">
            <span class="material-icons-sharp"> logout </span>
            <h3>Logout</h3>
          </a>
        </div>
      </aside>
      <!--------------- END OF ASIDE -------------------->
      <main>
        <h1>The Team</h1>
        <div class="insights">
          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>Sir John Lasala, 21</h1>
                <h3>
                  To be employed in a company where I can utilize my technical
                  skills and leadership capabilities to the company's growth and
                  personal development
                </h3>
              </div>
              <img
                src="assets/Lasala.png"
                style="width: 200px; height: 150px"
              />
            </div>
            <small class="text-muted"
              ><h4>
                Strong team-working skills, Committed and Hardworking
              </h4></small
            >
            <br />
            <small class="text-muted" style="color: #118488"
              >• MS WORD • MS EXCEL • MS PowerPoint • PLC Programming and DCS •
              AutoCAD</small
            >
          </div>
          <!------------ END OF Quality ------------------->

          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>Billy Bob Manigbas, 22</h1>
                <h3>
                  To bring my abilities and profession to work in order to
                  achieve growth and development in my chosen field, as well as
                  to be a part of a team working in the same direction to
                  achieve similar goals
                </h3>
              </div>
              <img
                src="assets/Manigbas.png"
                style="width: 200px; height: 150px"
              />
            </div>
            <small class="text-muted" style="color: #118488"
              >• PLC Programming and DCS • Piping and Instrumentation Diagram •
              MS WORD • MS EXCEL • MS PowerPoint</small
            >
          </div>
          <!------------ END OF Quality ------------------->

          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>April Joy Manzano, 22</h1>
                <h3>
                  An aspiring Instrumentation and Control Engineering Student.
                  Vigorous, result-oriented and innovative, looking for a
                  position in a company where I can utilize my knowledge and
                  skills in Instrumentation and Control
                </h3>
              </div>
              <img
                src="assets/Manzano.png"
                style="width: 200px; height: 150px"
              />
            </div>
            <small class="text-muted"
              ><h4>
                Strong team-working skills, Committed and Hardworking
              </h4></small
            >
            <small class="text-muted" style="color: #118488"
              >• MS WORD • MS EXCEL • MS PowerPoint • PLC Automation •
              AutoCAD</small
            >
          </div>
          <!------------ END OF Quality ------------------->

          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>Ryndel Raphael Nazario, 21</h1>
                <h3>
                  To be hired in a company that will benefit from my skills and
                  in the same time where I can practical the technical skills I
                  have learned and work in an environment that is suited for me
                  which will result in the growth of both the company and myself
                </h3>
              </div>
              <img
                src="assets/Nazario.png"
                style="width: 200px; height: 150px"
              />
            </div>
            <small class="text-muted"
              ><h4>Great communication with team</h4></small
            >
            <br />
            <small class="text-muted" style="color: #118488"
              >• MS Office Product • AutoCAD • C++ • Step ladder PLC Programming
            </small>
          </div>
          <!------------ END OF Quality ------------------->

          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>Kristine Joy Ovivir, 22</h1>
                <h3>
                  To work with a company that appreciates innovation so that I
                  can enhance my knowledge and skills to give my best for the
                  growth of the company
                </h3>
              </div>
              <img
                src="assets/Ovivir.png"
                style="width: 200px; height: 150px"
              />
            </div>
            <small class="text-muted"
              ><h4>
                Problem solving, good communication, fast learner and
                Independent with strong leadership skills
              </h4></small
            >
            <br />
            <small class="text-muted" style="color: #118488"">• MS Office Product • AutoCAD </small>
          </div>
          <!------------ END OF Quality ------------------->

          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>Wilfredo Padrigon Jr., 22</h1>
                <h3>
                  An efficient worker with the mindset to improve all aspects of
                  production, from product design to manufacturing processes.
                  Design majority of process and a programmer with propensity
                  for making changes that drastically improve operation
                </h3>
              </div>
              <img
                src="assets/Padrigon.png"
                style="width: 180px; height: 130px"
              />
            </div>
            <small class="text-muted"
              ><h4>
                Strong communication skills and team-working skills
              </h4></small
            >
            <br />
            <small class="text-muted" style="color: #118488"
              >• MS Word • MS PowerPoint • PLC Programming • Ladder Diagram •
              DCS • AutoCAD
            </small>
          </div>
          <!------------ END OF Quality ------------------->

          <div class="Quality">
            <div class="middle">
              <div class="left">
                <h1>Unique Patingo, 22</h1>
                <h3>
                  Aspiring to obtain and enhance my fullest potential in
                  understanding processes and control, analyzing data in
                  instrumentation, problem-solving, and ability to work well
                  with people
                </h3>
              </div>
              <img
                src="assets/Patingo.png"
                style="width: 200px; height: 150px"
              />
            </div>
            <small class="text-muted"
              ><h4>
                Ability to work under pressure, Dedicated and hardworking
                individual with quick learning capacity, Excellent communication
                interpersonal skills
              </h4></small
            >
            <br />
            <small class="text-muted" style="color: #118488"
              >• AutoCAD • MS Applications
            </small>
          </div>
          <!------------ END OF Quality ------------------->
        </div>
        <div class="data-sensors"></div>
      </main>
      <!--------------- END OF MAIN -------------------->
      <div class="right">
        <div class="top">
          <button id="menu-btn">
            <span class="material-icons-sharp"> menu</span>
          </button>
          <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
          </div>
          <div class="profile">
            <div class="info">
              <p>Hey, 
                <b>
                  <?php
                    echo  $_SESSION['firstname'];
                    echo " ";
                    echo   $_SESSION['lastname'];
                  ?>
                </b>
              </p>
              <small class="text-muted">Admin</small>
            </div>
            <div class="profile-photo">
              <img src="assets/user.png" />
            </div>
          </div>
        </div>
      </div>
      <!--------------- END OF RIGHT -------------------->
    </div>
  </body>
  <script src="js/index.js"></script>
</html>
