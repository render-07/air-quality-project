<?php
  $host="localhost"; // BY DEFAULT
  $user="root"; // BY DEFAULT
  $password= ""; // BY DEFAULT
  $db="air_quality"; // YOUR DATABASE NAME
  $connect = mysqli_connect($host,$user, $password, $db);

  if(!$connect) {
      die("There was an error connecting to the database!!!!");
  }


/*
  if ($connect) {
    echo "Connected";
  }else {
      die("DATABASE ERROR: ".mysqli_error);
      preg_match("/^[A-Za-z ]*$/",$firstname)&&preg_match("/^[A-Za-z ]*$/",$lastname)&&preg_match("/^[A-Za-z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$email)&&(mysqli_num_rows($result) <= 0)&&preg_match("/[a-zA-Z0-9]{6,}/",$password)&&($password == $confirmpassword)&&preg_match("/^[A-Za-z0-9]*$/",$username)&&(mysqli_num_rows($usercheck) <= 0)
  }
*/


?>