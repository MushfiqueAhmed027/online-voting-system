<?php session_start(); ?>
<?php
include 'header.php';
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
?>
<?php
//get user input
if (isset($_POST['add_parties'])) {
    $partiesName = trim($_POST['party_name']);
    $partiesPhoto = '';
    $errors = [];
    $msgs = [];
    //validate

    if (strlen($_POST['party_name']) < 3) {
        $errors[] = 'party name must be at least 3 characters';
    }

    if (!empty($_FILES['party_photo']['tmp_name'])) {
        $partiesPhoto = time() . $_FILES['party_photo']['name'];
        $dest = '../uploads/party_images/' . $partiesPhoto;


        // create an image manager instance with favored driver
        $image = new ImageManager();
        
        $image->make($_FILES['party_photo']['tmp_name'])
                ->resize(300,200)
                ->save($dest);

        
    }
//if no errors DB upload

    if (empty($errors)) {
        $query = $connection->prepare("INSERT INTO `parties`(parties_name,parties_photo) VALUES(:parties_name,:parties_photo)");
        $query->bindValue(':parties_name', $partiesName);
        $query->bindValue(':parties_photo', $partiesPhoto);
        $query->execute();
        //message the user.
        $msgs[] = "parties added successfully";
    }
}
?>

<!-- Page Content -->
<div class="container">
  
       
        <div class="add_parties">
            <p class="h2">Add Party</p>
            <form action="add_parties.php" method="post" enctype="multipart/form-data">
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
                    <label for="party_name">parties Name</label>
                    <input type="text" name="party_name" id="party_name" class="form-control" required="1">
                </div>

                <div class="form-group">
                    <label for="party_photo">parties Photo</label>
                    <input type="file" name="party_photo" id="party_photo" class="form-control">
                </div>
                <div class="form-group">
                    <button name="add_parties" >Add parties</button>
                    <a href="parties.php" >Cancel</a>
                </div>
                
                
            </form>


        </div>

    <!-- /.row -->

</div>
<!-- /content container -->

<?php include_once 'footer.php'; ?>






