<?php
session_start();
if(!isset($_SESSION["session-token"]) || $_SESSION["session-token"] !="admin"){
   header("location: /index.php");
};
?>
