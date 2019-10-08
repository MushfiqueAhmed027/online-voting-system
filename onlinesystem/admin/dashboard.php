<?php
session_start();
if(empty($_SESSION) || empty($_SESSION['id'] || empty($_SESSION['username']))){
    header('Location: login.php');
}

?>
<?php
include_once 'header.php';?>

<div class="main-conteiner">
    <div class="logout">
        <p>You are Logged in </p>
        <a href="login.php"><input type="submit" name="logout" value="Logout"></a>
       
        
</div>
   

<?php include_once 'footer.php'; ?>
