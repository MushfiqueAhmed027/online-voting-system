<?php


session_start();

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION) || empty($_SESSION['id'] || empty($_SESSION['username']))){
    header('Location: log.php');
}
include_once 'partials/sub_header.php';
?>
<?php
// retrieving candidate(s) results based on position
if (isset($_POST['Submit'])){   

  $vote = addslashes( $_POST['vote'] );
  
    $results = mysql_query("SELECT * FROM candidates where candidates_name='$vote'");

    $row1 = mysql_fetch_array($results); // for the first candidate
    $row2 = mysql_fetch_array($results); // for the second candidate
      if ($row1){
      $candidate_name_1=$row1['candidates_name']; // first candidate name
      $candidate_1=$row1['num_votes']; // first candidate votes
      }

      if ($row2){
      $candidate_name_2=$row2['candidates_name']; // second candidate name
      $candidate_2=$row2['num_votes']; // second candidate votes
      }
}
    else
        // do nothing
?> 
<?php
// retrieving positions sql query
$positions=mysql_query("SELECT * FROM candidates")

?>


<?php if(isset($_POST['submit'])){$totalvotes=$candidate_1+$candidate_2;} ?>


<?php if(isset($_POST['submit'])){echo $candidate_name_1;} ?>:<br>

<?php if(isset($_POST['submit'])){ if ($candidate_2 || $candidate_1 != 0)
    {echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>'

<?php if(isset($_POST['submit'])){ if ($candidate_2 || $candidate_1 != 0)
    {echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['submit']))
        {echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['submit'])){ echo $candidate_1;} ?>
<br>
<br>
<?php if(isset($_POST['submit'])){ echo $candidate_name_2;} ?>:<br>
<?php if(isset($_POST['submit'])){ if ($candidate_2 || $candidate_1 != 0)
    {echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>

<?php if(isset($_POST['submit'])){ if ($candidate_2 || $candidate_1 != 0)
    {echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['submit'])){ echo $candidate_2;} ?>

</body></html>

