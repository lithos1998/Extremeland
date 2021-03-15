<?php
session_start();
//matamos le session

session_destroy();

session_start();
//$_SESSION["usuario"] = "Gracias por visitarnos";
header("Location:index.php");