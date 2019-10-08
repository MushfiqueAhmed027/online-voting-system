<?php session_start();$page = 'candidates';?>

<?php include_once 'partials/sub_header.php';?>

<?php

$query = $connection->prepare('SELECT * FROM `candidates`');
$query->execute();
$data = $query->fetchAll();




?>




<!-- Page Content -->
<div class="container">
    <div class="row">
       
        
            
        <p><b>Candidate Details</b></p>
            <table>
                <thead>
                    <tr>
                        <td>candidates_ID</td>
                        <td>candidates_Name</td>
                        <td>candidates_Photo</td>
                        
                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d){?>
                    <tr>
                        <td><?php echo $d['candidates_id'];?></td>
                        <td><?php echo $d['candidates_name'];?></td>
                        <td><img width="50px;"src="uploads/candidate_images/<?php echo $d['candidates_photo'];?>"></td>
                      
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            
            
       
    </div>
    <!-- /.row -->

</div>
<!-- /content container -->

<?php include_once 'partials/footer.php'; ?>





