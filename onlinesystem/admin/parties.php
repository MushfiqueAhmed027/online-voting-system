<?php session_start();$page = 'parties';?>

<?php include_once 'header.php';?>

<?php

$query = $connection->prepare('SELECT * FROM `parties`');
$query->execute();
$data = $query->fetchAll();




?>




<!-- Page Content -->
<div class="container">
    <div class="row">
       
        
            
            
            <table>
                <thead>
                    <tr>
                        <td>Parties_ID</td>
                        <td>parties_Name</td>
                        <td>parties_Photo</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d){?>
                    <tr>
                        <td><?php echo $d['parties_id'];?></td>
                        <td><?php echo $d['parties_name'];?></td>
                        <td><img src="../uploads/party_images/<?php echo $d['parties_photo'];?>" width="100"></td>
                        <td align="center">
                            <a class="btn btn-primary" href="edit_parties.php?id=<?php echo $d['parties_id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="delete_parties.php?id=<?php echo $d['parties_id'];?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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



