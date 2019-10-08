<?php
require 'connection.php';


$stmt = $connection->prepare('DELETE FROM `parties` WHERE `parties_id`= :parties_id');
$stmt->bindValue(':parties_id',$_GET['id'],PDO::PARAM_INT);
$stmt->execute();

if($stmt->rowCount() === 1){
    $stmt = $connection->prepare('ALTER TABLE `parties` AUTO_INCREMENT = 1');
    $stmt->execute();
}



header('Location: parties.php');





