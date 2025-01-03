<?php 

require_once 'config.php';
session_start();

if(isset($_POST['data_change'])){

try{
$userid = $_POST['id'];
$userfirstname = $_POST['firstname'];
$userlastname = $_POST['lastname'];
$useremail = $_POST['email'];
$userpassword = $_POST['password'];
$userrole = $_POST['role'];



$sql = $conn->prepare("UPDATE users SET
                       id = :id,
                       firstname = :firstname,
                       lastname = :lastname,
                       email = :email,
                       password = :password,
                       urole = :role
                       WHERE id = :id");

$sql->bindParam(":id", $userid);
$sql->bindParam(":firstname", $userfirstname);
$sql->bindParam(":lastname", $userlastname);
$sql->bindParam(":email", $useremail);
$sql->bindParam(":password", $userpassword);
$sql->bindParam(":role", $userrole);
$sql->execute();
$_SESSION['change_success'] = "U already change a data!!";

}catch(PDOException $error){
    echo $error->getMessage();
}

header("location: admin.php");
}


?>