<?php
include_once 'header.php';?>

session_start();
    
}

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $errors = [];
    $msgs = [];
    
    
    
    //validation
    if (strlen($username) < 6) {
        $errors[] = "Username must be at least 6 characters";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    
    //if no errors
    
    if(empty($errors)){
        $query = $connection->prepare('SELECT admin_id,email,password FROM `admins` WHERE username = :username');
        $query->bindValue('username', strtolower($username));
        $query->execute();
        $data = $query->fetch();
       
        
        if($query->rowCount() === 1 && password_verify($password, $data['password'])){
            $_SESSION['id'] = $data['admin_id'];
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            
        }
        
        $errors[] = 'Invalid username or password ';        
        
    }
}
?>


<div class="main-conteiner">
    <div class="login">
        <i class="fa fa-user" aria-hidden="true"></i> Log in
        
        <form id="login-box" action="" method="post">
            <?php if (!empty($errors)) { ?>
            <?php foreach ($errors as $error) { ?>
                <div class="errorbox">
                    <p><?php echo $error; ?></p>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (!empty($msgs)) { ?>
            <?php foreach ($msgs as $msg) { ?>
                <div class="msgbox">
                    <p><?php echo $msg; ?></p>
                </div>
            <?php } ?>
        <?php } ?>
            <input type="text" name="username" placeholder="username" required=""><br>
            <input type="text" name="email" placeholder="email" required=""><br>
            <input type="password" name="password"  placeholder="password" required=""><br>

            <input type="submit" name="login" value="LOG IN">
            <input type="submit" name="registration" value="Registration">
        </form>

    </div>
</div>
<?php include_once 'footer.php'; ?>

