<?php
require 'connection.php';


$stmt = $connection->prepare('DELETE FROM `candidates` WHERE `candidates_id`= :candidates_id');
$stmt->bindValue(':candidates_id',$_GET['id'],PDO::PARAM_INT);
$stmt->execute();

if($stmt->rowCount() === 1){
    $stmt = $connection->prepare('ALTER TABLE `candidates` AUTO_INCREMENT = 1');
    $stmt->execute();
}



header('Location: candidates.php');






