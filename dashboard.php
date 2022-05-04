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
    <script>
      jQuery(function ($) {
        $("table tr:lt(11)").addClass("active");

        $("a.load_more").on("click", function (e) {
          e.preventDefault();
          var $rows = $("table tr");

          var lastActiveIndex = $rows.index($rows.filter(".active").last());

          $rows.filter(":lt(" + (lastActiveIndex + 13) + ")").addClass("active");

          // hide the button when all elements visible
          $(this).toggle($rows.filter(":hidden").length !== 0);
        });
      });
    </script>
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
          <a href="#" class="active">
            <span class="material-icons-sharp">grid_view</span>
            <h3>Dashboard</h3>
          </a>
          <a href="http://localhost/air_quality_project/about-us.php">
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
        <h1>Dashboard</h1>
        <div class="insights">
          <div class="Quality">
            <span class="material-icons-sharp">air</span>
            <div class="middle">
              <div class="left">
                <h3>Air Quality</h3>
                <?php
                  include('connectionToDb.php');
                  $getAirQuality = "SELECT airQualityIndex, COUNT(airQualityIndex) AS `value_occurrence` 
                  FROM data WHERE timestamp >= NOW() - INTERVAL 1 HOUR GROUP BY 
                  airQualityIndex ORDER BY `value_occurrence` DESC LIMIT 1";
                  $result = mysqli_query($connect, $getAirQuality) or die('error');
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo
                    "<h1>".$row["airQualityIndex"]."</h1>";
                  }         
                ?>
              </div>
              <div class="progress ">
                <svg>
                <?php
                    include('connectionToDb.php');
                    $getAirQuality = "SELECT airQualityIndex, COUNT(airQualityIndex) AS `value_occurrence` 
                    FROM data WHERE timestamp >= NOW() - INTERVAL 1 HOUR GROUP BY 
                    airQualityIndex ORDER BY `value_occurrence` DESC LIMIT 1";
                    $result = mysqli_query($connect, $getAirQuality) or die('error');
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo
                      $airQuality = $row["airQualityIndex"];
                      if (strcmp($airQuality,"GOOD") == 0) { // green
                        echo '<circle id="air-quality-flow-good" cx="38" cy="38" r="36"></circle>';

                      } else if (strcmp($airQuality,"MEDIUM") == 0) { // blue
                        echo '<circle id="air-quality-flow-medium" cx="38" cy="38" r="36"></circle>';

                      } else if (strcmp($airQuality,"BAD") == 0) { // yellow
                        echo '<circle id="air-quality-flow-bad" cx="38" cy="38" r="36"></circle>';

                      } else if (strcmp($airQuality,"MODERATE DANGER") == 0) { // orange
                        echo '<circle id="air-quality-flow-moderate-danger" cx="38" cy="38" r="36"></circle>';

                      }else if (strcmp($airQuality,"CONSIDERABLE DANGER") == 0) { // red
                        echo '<circle id="air-quality-flow-considerable-danger" cx="38" cy="38" r="36"></circle>';

                      }else if (strcmp($airQuality,"HIGH DANGER") == 0) { // 
                        echo '<circle id="air-quality-flow-high-danger" cx="38" cy="38" r="36"></circle>';

                      }
                    }
                  ?>
                </svg>
                <div class="number">
                  <p>10001
                  <!-- Average -->
                  </p>
                </div>
              </div>
            </div>
            <small class="text-muted">Last 1hr</small>
          </div>
          <!------------ END OF Quality ------------------->
          <div class="Flow">
            <span class="material-icons-sharp">air</span>
            <div class="middle">
              <div class="left">
                <h3>Air Flow</h3>
                <?php
                  include('connectionToDb.php');
                  $getAirQuality = "SELECT airQualityIndex, COUNT(airQualityIndex) AS `value_occurrence` 
                  FROM data WHERE timestamp >= NOW() - INTERVAL 1 HOUR GROUP BY 
                  airQualityIndex ORDER BY `value_occurrence` DESC LIMIT 1";
                  $result = mysqli_query($connect, $getAirQuality) or die('error');
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo
                    "<h1>".$row["airQualityIndex"]."</h1>";
                  }         
                ?>
              </div>
              <div class="progress">
              <svg>
                  <?php
                    include('connectionToDb.php');
                    $getAirQuality = "SELECT airQualityIndex, COUNT(airQualityIndex) AS `value_occurrence` 
                    FROM data WHERE timestamp >= NOW() - INTERVAL 1 HOUR GROUP BY 
                    airQualityIndex ORDER BY `value_occurrence` DESC LIMIT 1";
                    $result = mysqli_query($connect, $getAirQuality) or die('error');
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo
                      $airQuality = $row["airQualityIndex"];
                      if (strcmp($airQuality,"GOOD") == 0) { // green
                        echo '<circle id="air-quality-flow-good" cx="38" cy="38" r="36"></circle>';

                      } else if (strcmp($airQuality,"MEDIUM") == 0) { // blue
                        echo '<circle id="air-quality-flow-medium" cx="38" cy="38" r="36"></circle>';

                      } else if (strcmp($airQuality,"BAD") == 0) { // yellow
                        echo '<circle id="air-quality-flow-bad" cx="38" cy="38" r="36"></circle>';

                      } else if (strcmp($airQuality,"MODERATE DANGER") == 0) { // orange
                        echo '<circle id="air-quality-flow-moderate-danger" cx="38" cy="38" r="36"></circle>';

                      }else if (strcmp($airQuality,"CONSIDERABLE DANGER") == 0) { // red
                        echo '<circle id="air-quality-flow-considerable-danger" cx="38" cy="38" r="36"></circle>';

                      }else if (strcmp($airQuality,"HIGH DANGER") == 0) { // 
                        echo '<circle id="air-quality-flow-high-danger" cx="38" cy="38" r="36"></circle>';

                      }
                    }
                  ?>
                </svg>
                <div class="number">
                  <p>20</p>
                </div>
              </div>
            </div>
            <small class="text-muted">Last 1hr</small>
          </div>
        </div>
        <!------------ END OF Flow ------------------->
        <div class="data-sensors">
          <h2>Data</h2>
          <table style="width:100%" class="table-reveal" id="table-reveal-1">
            <thead>
              <tr>
                <th>Log Number</th>
                <th>Date & Time</th>
                <th>Humidity</th>
                <th>Temperature</th>
                <th>CO Gas Value</th>
                <th>Air Flow (In/min)</th>
                <th>PM 1 (μg/m3)</th>
                <th>PM 2.5 (μg/m3)</th>
                <th>PM 10 (μg/m3)</th>
                <th>Air Quality index</th>
                <th>Air Quality Value</th>
              </tr>
            </thead>

            <tbody>
              <?php
                include('connectionToDb.php');
                $getAllData = "SELECT * from data";
                $result = mysqli_query($connect, $getAllData) or die('error');

                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                  echo
                  "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["timestamp"]."</td>
                    <td>".$row["humidity"]."</td>
                    <td>".$row["temperature"]."</td>
                    <td>".$row["coValue"]."</td>
                    <td>".$row["airFlow"]."</td>
                    <td>".$row["pm1"]."</td>
                    <td>".$row["pm2.5"]."</td>
                    <td>".$row["pm10"]."</td>
                    <td>".$row["airQualityIndex"]."</td>
                    <td>".$row["airQualityValue"]."</td>
                  </tr>";
                }
              ?>
            </tbody>
          </table>
          <br>
          <a class="load_more" href="#">>> Load more</a>
        </div>
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
  </body>
  <script src="js/index.js"> </script>
</html>
