<?php session_start();$page = 'candidates';?>

<?php include_once 'header.php';?>

<?php

$query = $connection->prepare('SELECT * FROM `candidates`');
$query->execute();
$data = $query->fetchAll();




?>




<!-- Page Content -->
<div class="container">
    <div class="row">
       
        
            
            
            <table>
                <thead>
                    <tr>
                        <td>candidates_ID</td>
                        <td>candidates_Name</td>
                        <td>candidates_Photo</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d){?>
                    <tr>
                        <td><?php echo $d['candidates_id'];?></td>
                        <td><?php echo $d['candidates_name'];?></td>
                        <td><img width="50px;"src="../uploads/candidate_images/<?php echo $d['candidates_photo'];?>"></td>
                        <td align="center">
                            <a class="btn btn-primary" href="edit_candidates.php?id=<?php echo $d['candidates_id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="delete_candidates.php?id=<?php echo $d['candidates_id'];?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <i class="" aria-hidden="true"></i>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            
            
       
    </div>
    <!-- /.row -->

</div>
<!-- /content container -->

<?php include_once 'footer.php'; ?>




