<?php session_start(); ?>
<?php
include 'header.php';
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
?>
<?php
//get user input
if (isset($_POST['add_candidates'])) {
    $candidatesName = trim($_POST['can_name']);
    $candidatesPhoto = '';
    $errors = [];
    $msgs = [];
    //validate

    if (strlen($_POST['can_name']) < 3) {
        $errors[] = 'Category name must be at least 3 characters';
    }

    if (!empty($_FILES['can_photo']['tmp_name'])) {
        $candidatesPhoto = time() . $_FILES['can_photo']['name'];
        $dest = '../uploads/candidate_images/' . $candidatesPhoto;


        // create an image manager instance with favored driver
        $image = new ImageManager();
        
        $image->make($_FILES['can_photo']['tmp_name'])
                ->resize(400,200)
                ->save($dest);

        
    }
//if no errors DB upload

    if (empty($errors)) {
        $query = $connection->prepare("INSERT INTO `candidates`(candidates_name,candidates_photo) VALUES(:candidates_name,:candidates_photo)");
        $query->bindValue(':candidates_name', $candidatesName);
        $query->bindValue(':candidates_photo', $candidatesPhoto);
        $query->execute();
        //message the user.
        $msgs[] = "candidates added successfully";
    }
}
?>

<!-- Page Content -->
<div class="container">

        <div class="add_parties">
            <p class="h2">Add Candidates</p>
            <form action="add_candidates.php" method="post" enctype="multipart/form-data">
                <?php if (!empty($errors)) { ?>
                    <div >
                        <?php foreach ($errors as $error) { ?>
                            <p><?php echo $error ?></p>  
                        <?php } ?>
                    </div>   
                <?php } ?>
                <?php if (!empty($msgs)) { ?>
                    <div >
                        <?php foreach ($msgs as $msg) { ?>
                            <p><?php echo $msg ?></p>  
                        <?php } ?>
                    </div>   
                <?php } ?>
                <div class="form-group">
                    <label for="can_name">candidates Name</label>
                    <input type="text" name="can_name" id="can_name" class="form-control" required="1">
                </div>

                <div class="form-group">
                    <label for="can_photo">candidates Photo</label>
                    <input type="file" name="can_photo" id="can_photo" class="form-control">
                </div>
                <div class="form-group">
                    <button name="add_candidates" >Add Candidates</button>
                    <a href="candidates.php" >Cancel</a>
                </div>
                
                
            </form>


        </div>

    <!-- /.row -->

</div>
<!-- /content container -->

<?php include_once 'footer.php'; ?>






