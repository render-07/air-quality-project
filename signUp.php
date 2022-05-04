<?php
    require 'connectionToDb.php';

    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) 
    && !empty($_POST['email']) && !empty($_POST['username']) 
    && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        $firstname = $_POST['firstname'];   
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if($password != $confirmPassword) {
            header("location: sign-up.php?signup_status=password_does_not_match");
            exit();
        }

        $firstname = mysqli_real_escape_string($connect,$firstname);
        $lastname = mysqli_real_escape_string($connect,$lastname);
        $email = mysqli_real_escape_string($connect,$email);
        $username = mysqli_real_escape_string($connect,$username);
        $passhashed = password_hash($password,PASSWORD_DEFAULT);
        $password = mysqli_real_escape_string($connect,$passhashed);

        $insert = "INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, 
        `password`, `timestamp`) 
        VALUES (NULL, '$firstname', '$lastname', '$email', '$username', '$passhashed', NULL)";
        $result = mysqli_query($connect, $insert);

        if($result === true) {
            header("location: sign-up.php?signup_status=successfully_signed_up");
            exit();
        }
        else {
            header("location: sign-up.php?signup_status=error");
            exit();
        }      
    } else {
        header("location: sign-up.php?signup_status=error");
        exit();
    }

    $connect->close();
?>