
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
$query = $connection->prepare('SELECT candidates_name,candidates_photo FROM `candidates` WHERE `candidates_id`= :candidates_id');
$query->bindValue(':candidates_id',$_GET['id'], PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();


//get user input
if (isset($_POST['edit_candidates'])) {
    $candidatesName = trim($_POST['candidates_name']);
    $candidatesPhoto = $data['candidates_photo'];
    $errors = [];
    $msgs = [];
    //validate

    if (strlen($_POST['candidates_name']) < 3) {
        $errors[] = 'candidates name must be at least 3 characters';
    }

    if (!empty($_FILES['candidates_photo']['tmp_name'])) {
        $candidatesPhoto = time() . $_FILES['candidates_photo']['name'];
        $dest = '../uploads/candidate_images/' . $candidatesPhoto;
        // create an image manager instance with favored driver
        $image = new ImageManager();

        $image->make($_FILES['candidates_photo']['tmp_name'])
                ->resize(300, 200)
                ->save($dest);
        unlink('../uploads/candidate_images/' . $data['candidates_photo']);
        //move_uploaded_file($_FILES['cat_photo']['tmp_name'], $dest);
    }
//if no errors DB upload

    if (empty($errors)) {
        $query = $connection->prepare("UPDATE `candidates` SET `candidates_name` = :candidates_name ,`candidates_photo`= :candidates_photo WHERE `candidates_id`= :candidates_id");
        $query->bindValue(':candidates_id', $_GET['id'], PDO::PARAM_INT);
        $query->bindValue(':candidates_name', $candidatesName);
        $query->bindValue(':candidates_photo', $candidatesPhoto);
        $query->execute();
//        var_dump($query->execute());die();
        if ($query->rowCount() === 1) {
            //message the user.
            $msgs[] = "candidates updated successfully";


            $query = $connection->prepare('SELECT * FROM `candidates` WHERE `candidates_id`= :candidates_id');
            $query->bindValue(':candidates_id', $_GET['id'], PDO::PARAM_INT);
            $query->execute();
            $data = $query->fetch();
        }
    }
}
?>
<!-- Page Content -->
<div class="container">
    <div class="row">

            <p class="h2">Edit Category</p>
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
                    <label for="candidates_name">Category Name</label>
                    <input type="text" name="candidates_name" id="candidates_name" class="form-control" value="<?php echo $data['candidates_name']; ?>" required="1">
                </div>

                <div class="form-group">

                    <label for="candidates_photo">candidates Photo</label>
                    <img width="100px;"src="../uploads/candidates_images/<?php echo $data['candidates_photo']; ?>" class="mb-4">
                    <input type="file" name="candidates_photo" id="candidates_photo" class="form-control">
                </div>
                <div class="form-group">
                    <button name="edit_candidates" class="btn btn-success">Edit candidates</button>
                    <a href="candidates.php" class="btn btn-danger">Cancel</a>
                </div>

            </form>


       
    </div>
    <!-- /.row -->

</div>
<!-- /content container -->

<?php include_once 'footer.php'; ?>







