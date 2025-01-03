<?php 
    session_start();
    require_once 'config.php';

    $user_Id = $_GET['user_id'];  
    $sql = $conn->prepare("DELETE FROM users WHERE id = :userId");
    $sql->bindParam(':userId', $user_Id, PDO::PARAM_INT);
    $sql->execute();
    
    header("location: admin.php");
?>