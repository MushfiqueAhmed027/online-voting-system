<?php session_start();
include_once 'partials/sub_header.php';
?>
<?php

if(empty($_SESSION) || empty($_SESSION['id'] || empty($_SESSION['username']))){
    header('Location: log.php');
}

?>

<div class="v_logout">
    <a href="log.php"> <button type="submit" name="logout" value="logout">Logout</button></a>
</div>

<div class="voter_nav">
    <a href="election_laws.php">Election</a>
    <a href="vote.php">vote</a>
    <a href="candidate_details.php">candidate details</a>
   <a href="election_laws.php">view result</a>
</div>



