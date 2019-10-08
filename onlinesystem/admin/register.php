<?php
include_once 'header.php';

require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //get the data input by user
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $errors = [];
    $msgs = [];

    //validattion
    if (strlen($username) < 6) {
        $errors[] = "Username must be at least 6 characters";
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = "Invalid Email Format";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    //if no errors

    if (empty($errors)) {

        $activation_token = sha1($email . time() . $_SERVER['REMOTE_ADDR']);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare('INSERT INTO `admin`(`username`,`email`,`password`,`activation_token`) VALUES(:username,:email,:password,:activation_token)');
        $query->bindValue('username', strtolower($username));
        $query->bindValue('email', strtolower($email));
        $query->bindValue('password', $password);
        $query->bindValue('activation_token', $activation_token);
        $query->execute();

        $msgs[] = "Registration done successfully!";


        //email the user
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = '616addff6dc519';                 // SMTP username
            $mail->Password = 'ae957ffb142ec1';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 2525;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('no-reply@onlnxm.com', 'Admin-onlineExam');
            $mail->addAddress($email, $username);     // Add a recipient
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Activation Link';
            $mail->Body = '<p>Hi, ' . $username . '</p>'
                    . '<p><a href="http://localhost/onlinesystem/admin/activate.php?token=' . $activation_token . '">Click to activate</a></p>';
            $mail->send();
            $msgs[] = 'Message has been sent';
        } catch (Exception $e) {
            $errors[] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
    //show message to user
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

            <a href="login.php"> <input type="submit" name="login" value="LOG IN"></a>
            <input type="submit" name="registration" value="Registration">
        </form>

    </div>
</div>


<?php include_once 'footer.php'; ?>