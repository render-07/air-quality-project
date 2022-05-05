<?php
    $host="localhost"; // BY DEFAULT
    $user="root"; // BY DEFAULT
    $password= ""; // BY DEFAULT
    $db="air_quality"; // YOUR DATABASE NAME
    $connect = mysqli_connect($host,$user, $password, $db);

    if(!$connect) {
        die("There was an error connecting to the database!!!!");
    } else { 
        echo "Connected to mysql database. "; 
    }

     // If values send by NodeMCU are not empty then insert into MySQL database table
    if (!empty($_POST['humidity']) && !empty($_POST['temperature']) 
        && !empty($_POST['co']) && !empty($_POST['airFlowValue']) 
        && !empty($_POST['pm1']) && !empty($_POST['pm25']) 
        && !empty($_POST['pm10']) && !empty($_POST['airQuality']) 
        && !empty($_POST['airQualityValue'])) {

        $humidity = $_POST['humidity'];
        $temperature = $_POST['temperature'];
        $co = $_POST['co'];
        $airFlowValue = $_POST['airFlowValue'];
        $pm1 = $_POST['pm1'];
        $pm25 = $_POST['pm25'];
        $pm10 = $_POST['pm10'];
        $airQuality = $_POST['airQuality'];
        $airQualityValue = $_POST['airQualityValue'];
        
        $insert = "INSERT INTO `data` (`id`, `timestamp`, `humidity`, `temperature`, `coValue`, 
        `airFlow`, `pm1`, `pm2.5`, `pm10`, `airQualityIndex`, `airQualityValue`) 
        VALUES (NULL,  NULL, '$humidity', '$temperature', '$co', '$airFlowValue', '$pm1', 
        '$pm25', '$pm10', '$airQuality', '$airQualityValue')";
        $result = mysqli_query($connect, $insert);

        if ($result === true) {
            echo "Values inserted in MySQL database table.";
        } else {
            echo "Error: " . $insert . "<br>" . $connect->error;
        }
    }
    // Close MySQL connection
    $connect->close();
?>
