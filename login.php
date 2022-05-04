<?php
    require 'connectionToDb.php';
    session_start();

    if(!empty($_POST['username']) && !empty($_POST['password']) == true) {
        $username = mysqli_real_escape_string($connect,$_POST['username']);
        $password = mysqli_real_escape_string($connect,$_POST['password']);

        $sql = "SELECT * FROM `users` WHERE `username`='$username'";
        $result = mysqli_query($connect, $sql);
        $resultcheck = mysqli_num_rows($result);

        if($resultcheck < 1) {
            header("location: index.php?login_status=wrong_password_or_username");
            exit();  
        }
        else {
            if ($row = mysqli_fetch_assoc($result)) {
                $passhashedpwdcheck = password_verify($password, $row['password']);
                if($passhashedpwdcheck == false) {
                    header("location: index.php?login_status=wrong_password_or_username");
                    exit();
                } else if ($passhashedpwdcheck == true) {
                    $_SESSION['is_logged'] = true;
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['first'] = $row['firstname'];
                    header("location: dashboard.php");
                    exit();
                }
            }         
        }
    }      
 ?>