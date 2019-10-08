<?php


session_start();

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION) || empty($_SESSION['id'] || empty($_SESSION['username']))){
    header('Location: log.php');
}
include_once 'partials/sub_header.php';
?>
    <?php
$vote = $_REQUEST['vote'];
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("onlinesystem", $con);

mysql_query("UPDATE candidates SET num_votes=num_votes+1 WHERE candidates_name='$vote'");

mysql_close($con);
?> 
