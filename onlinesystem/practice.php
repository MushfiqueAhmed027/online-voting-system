<?php


session_start();

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION) || empty($_SESSION['id'] || empty($_SESSION['username']))){
    header('Location: log.php');
}
include_once 'partials/sub_header.php';
?>
<?php
$query = $connection->prepare('SELECT * FROM `candidates`');
$query->execute();
$data = $query->fetchAll();

?>


              
<?php

//loop through all table rows
//if (mysql_num_rows($result)>0){
  if (isset($_POST['submit'])){
     

$vote=$_REQUEST['vote'];
$query = $connection->prepare("UPDATE candidates SET num_votes=num_votes+1 WHERE candidates_name='$vote'");
$result = $query("SELECT * FROM candidates where candidates_name='num_votes'");
 $row=mysql_fetch_array($result);

while ($row=mysql_fetch_array($result)){

echo "<td>" . $row['candidates_name']."</td>";
echo "<td><input type='radio' name='vote' value='$row[candidates_name]' onclick='getVote(this.value)' /></td>";
echo "</tr>";
}
mysql_free_result($result);

//}
  
if($query->rowCount() === 1 && password_verify($password, $data['password'])){
            $_SESSION['id'] = $data['voter_id'];
            
            header('Location: voter.php');
            
        }

  }
?>

<script type="text/javascript">
function getVote(int)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","save.php?vote="+int,true);
xmlhttp.send();
}


</script>

<script type="text/javascript">
$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function()
    {
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })
        
    });
   j('.refresh').css({color:"green"});
});
</script>

<table>
    
   <thead>
                    <tr>
                        <td>candidates_ID</td>
                        <td>candidates_Name</td>
                        <td>candidates_Photo</td>
                        <td>vote</td>          
                    </tr>
   </thead>
   <tbody>
     <?php foreach ($data as $d){?>
                    <tr>
                        <td><?php echo $d['candidates_id'];?></td>
                        <td><?php echo $d['candidates_name'];?></td>
                        <td><img width="50px;"src="uploads/candidate_images/<?php echo $d['candidates_photo'];?>"></td>
                     
                       <td><form action="" method="post">
                               <input type="radio" name="vote" value="vote">vote<br>
                            </form>
                        </td>
                         
                    </tr>
                    
 
    <?php }?>
</tbody>
 <td><input type="submit" name="submit" value="submit" /></td> 

</table>