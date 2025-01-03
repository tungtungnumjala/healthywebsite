<?php
session_start();
require_once 'config.php';

if (isset($_POST['sleep'])) {
    $sleephour = $_POST['sleephour'];
    $bedtime = $_POST['bedtime'];
    $wakeup = $_POST['wakeup'];
    $userId = $_GET['id'];

    if (!empty($sleephour) && !empty($bedtime) && !empty($wakeup)) {

        $sql = $conn->prepare("UPDATE users SET sleephour = :sleephour, bedtime = :bedtime, wakeup = :wakeup WHERE id = :userId");

        $sql->bindParam(':sleephour', $sleephour, PDO::PARAM_STR);
        $sql->bindParam(':bedtime', $bedtime, PDO::PARAM_STR);
        $sql->bindParam(':wakeup', $wakeup, PDO::PARAM_STR);
        $sql->bindParam(':userId', $userId, PDO::PARAM_INT);

        header("location: patient.php");
    } 
}

if (isset($_POST['exercise'])) {
    $userId = $_GET['id']; 
    $exercise = $_POST['exerxise'];
    $time = $_POST['time'];

    $sql = $conn->prepare("UPDATE users SET exercise = :exercise, exercise_time = :time WHERE id = :user_id");
    $sql->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $sql->bindParam(':exercise', $exercise, PDO::PARAM_STR);
    $sql->bindParam(':time', $time, PDO::PARAM_STR);
    $sql->execute();
    header("location: patient.php");
}

if (isset($_POST['food'])) {
    $userId = $_GET['id']; 
    $meal1 = $_POST['meal1'];
    $meal2 = $_POST['meal2'];
    $meal3 = $_POST['meal3'];

    $sql = $conn->prepare("UPDATE users SET meal1 = :meal1, meal2 = :meal2, meal3 = :meal3 WHERE id = :user_id");
    $sql->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $sql->bindParam(':meal1', $meal1, PDO::PARAM_STR);
    $sql->bindParam(':meal2', $meal2, PDO::PARAM_STR);
    $sql->bindParam(':meal3', $meal3, PDO::PARAM_STR);
    $sql->execute();
    header("location: patient.php");
}

?>
