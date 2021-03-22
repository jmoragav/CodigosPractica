<?php


session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
header('Location: ' . "./silos.php");
die();

}

else{

session_destroy();
header('Location: ' . "./silos_view.php");
die();

}

?>