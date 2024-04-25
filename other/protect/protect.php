<?php
session_start();
if(!isset($_SESSION["session-token"]) || $_SESSION["session-token"] !="connected"){
   header("location: /index.php");
};
?>