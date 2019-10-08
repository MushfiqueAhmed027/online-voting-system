
<?php session_start();

if(empty($_SESSION) || empty($_SESSION['id'] || empty($_SESSION['username']))){
    header('Location: register.php');
}

?>
<?php
include 'header.php';
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
?>
<?php
$query = $connection->prepare('SELECT parties_name,parties_photo FROM `parties` WHERE `parties_id`= :parties_id');
$query->bindValue(':parties_id',$_GET['id'], PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();


//get user input
if (isset($_POST['edit_parties'])) {
    $partiesName = trim($_POST['parties_name']);
    $partiesPhoto = $data['parties_photo'];
    $errors = [];
    $msgs = [];
    //validate

    if (strlen($_POST['parties_name']) < 3) {
        $errors[] = 'parties name must be at least 3 characters';
    }

    if (!empty($_FILES['parties_photo']['tmp_name'])) {
        $partiesPhoto = time() . $_FILES['parties_photo']['name'];
        $dest = '../uploads/parties_images/' . $candidatesPhoto;
        // create an image manager instance with favored driver
        $image = new ImageManager();

        $image->make($_FILES['parties_photo']['tmp_name'])
                ->resize(300, 200)
                ->save($dest);
        unlink('../uploads/party_images/' . $data['parties_photo']);
        //move_uploaded_file($_FILES['cat_photo']['tmp_name'], $dest);
    }
//if no errors DB upload

    if (empty($errors)) {
        $query = $connection->prepare("UPDATE `parties` SET `parties_name` = :parties_name ,`parties_photo`= :parties_photo WHERE `parties_id`= :parties_id");
        $query->bindValue(':parties_id', $_GET['id'], PDO::PARAM_INT);
        $query->bindValue(':parties_name', $partiesName);
        $query->bindValue(':parties_photo', $partiesPhoto);
        $query->execute();
//        var_dump($query->execute());die();
        if ($query->rowCount() === 1) {
            //message the user.
            $msgs[] = "parties updated successfully";


            $query = $connection->prepare('SELECT * FROM `parties` WHERE `parties_id`= :parties_id');
            $query->bindValue(':parties_id', $_GET['id'], PDO::PARAM_INT);
            $query->execute();
            $data = $query->fetch();
        }
    }
}
?>
<!-- Page Content -->
<div class="container">
    <div class="row">

            <p class="h2">Edit parties</p>
            <form action="" method="post" enctype="multipart/form-data">
<?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger">
    <?php foreach ($errors as $error) { ?>
                            <p><?php echo $error ?></p>  
    <?php } ?>
                    </div>   
        <?php } ?>
        <?php if (!empty($msgs)) { ?>
                    <div class="alert alert-success">
    <?php foreach ($msgs as $msg) { ?>
                            <p><?php echo $msg ?></p>  
                    <?php } ?>
                    </div>   
                    <?php } ?>

                <div class="form-group">
                    <label for="parties_name">parties Name</label>
                    <input type="text" name="parties_name" id="parties_name" class="form-control" value="<?php echo $data['parties_name']; ?>" required="1">
                </div>

                <div class="form-group">

                    <label for="parties_photo">parties Photo</label>
                    <img width="100px;"src="../uploads/parties_images/<?php echo $data['parties_photo']; ?>" class="mb-4">
                    <input type="file" name="parties_photo" id="parties_photo" class="form-control">
                </div>
                <div class="form-group">
                    <button name="edit_parties" class="btn btn-success">Edit parties</button>
                    <a href="parties.php" class="btn btn-danger">Cancel</a>
                </div>

            </form>


       
    </div>
    <!-- /.row -->

</div>
<!-- /content container -->

<?php include_once 'footer.php'; ?>
