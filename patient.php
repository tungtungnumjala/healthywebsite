<?php
session_start();
require_once 'config.php';




if (isset($_GET['user_id'])) { 
    $userId = $_GET['user_id']; 

    $sql = $conn->prepare("SELECT * FROM users WHERE id = :userId");
    $sql->bindParam(':userId', $userId, PDO::PARAM_INT); 
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    $loggedInUserId = $_SESSION['id']; 
    $sql = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
    $sql->bindParam(':user_id', $loggedInUserId, PDO::PARAM_INT); 
    $sql->execute();
    $status = $sql->fetch(PDO::FETCH_ASSOC);

}elseif (!isset($_GET['user_id'])) {

    $loggedInUserId = $_SESSION['id']; 
    $sql = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
    $sql->bindParam(':user_id', $loggedInUserId, PDO::PARAM_INT); 
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    $loggedInUserId = $_SESSION['id']; 
    $sql = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
    $sql->bindParam(':user_id', $loggedInUserId, PDO::PARAM_INT); 
    $sql->execute();
    $status = $sql->fetch(PDO::FETCH_ASSOC);

}
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    

</head>

    
<body>
        

<header class="header">

        <div class="float-end" style="font-size:30px;">
        <?php echo "YOUR role is : " . $status['urole']; ?>
        </div>


<nav class="navbar">
        <div class="container">
    <a href="index.php">
        <img src="pg/home-icon.png" alt="Home Icon">
        <span>HOME</span>
    </a>
    


                <?php if($_SESSION['role'] == 'admin') { ?>
                    <a href="admin.php">
                    <img src="pg/role-icon.png" alt="role Icon">
                    <span>HOME</span>
                    </a>
                <?php } ?>

                <form action="" method="post">
                <a href="">
                    <button name="logout">
                    <img src="pg/logout-icon.png" alt="logout Icon">
                    <span>LOGOUT</span>
                    </button>
                    </a>
                </form>

                <?php if(isset($_POST['logout'])){
                    header("location: signin.php");
                    unset($_SESSION['role']);
                } ?>
            </div>
            </div>
            </nav>

            
    </header>

    

<center>
    <div class="patient-info-container">
    <div class="patient-image">
        <img src="pg/patient.jpg" alt="Patient Image">
    </div>
    <div class="patient-details">
        <?php
        
        echo "<h2>WELCOME   ,  " 
        . $user['firstname'] . " " . $user['lastname'] . "</h2><hr>";
        echo "<p>Your email: " . $user['email'] . "</p>";
        echo "<p>Your role: " . $user['urole'] . "</p>";

        ?>
    </div>
</div>
</center>

<div class="container" style="margin-top:100px;">
    <center>
        <div class="pt-info-container">
            <div class="pt-image" style="margin-top:100px;">  
                <img src="pg/patient.jpg" alt="Patient Image">
            </div>
            
            <div class="circle-button" id="sleep" onclick="showForm('sleepForm')">
                <img src="pg/sleep-icon.png" alt="1">
            </div>
            <div class="circle-button" id="exercise" onclick="showForm('exerciseForm')">
                <img src="pg/exercise-icon.png" alt="2"1    quoted_printable_decodeq    quoted_printable_decodeqqqq>
            </div>
            <div class="circle-button" id="food" onclick="showForm('foodForm')">
                <img src="pg/food-icon.png" alt="3">
            </div>
            
            <?php if($_SESSION['role'] == 'user') { ?>
            <div class="input-form" id="sleepForm">
                <h1>Sleep Detail</h1><hr>
                <form action="patient_db.php?id=<?php echo $user['id']; ?>" method="post">
                    <input type="text" class="form-control" name="sleephour" placeholder="Sleep hours">
                    <input type="text" class="form-control" name="bedtime" placeholder="Bedtime">
                    <input type="text" class="form-control" name="wakeup" placeholder="Wake-up time">
                    <button type="submit" name="sleep" class="btn btn-primary me-3 mt-3">INTERACT</button>
                </form>
            </div>

            <div class="input-form" id="exerciseForm">
                <h1>Exercise Detail</h1><hr>
                <form action="patient_db.php?id=<?php echo $user['id']; ?>" method="post">
                    <input type="text" class="form-control" name="exerxise" placeholder="exercise">
                    <input type="text" class="form-control" name="time" placeholder="Exercise time">
                    <button type="submit" name="exercise" class="btn btn-primary me-3 mt-3">INTERACT</button>
                </form>
            </div>

            <div class="input-form" id="foodForm">
                <h1>Food Detail</h1><hr>
                <form action="patient_db.php?id=<?php echo $user['id']; ?>" method="post">
                    <input type="text" class="form-control" name="meal1" placeholder="meal1">
                    <input type="text" class="form-control" name="meal2" placeholder="meal2">
                    <input type="text" class="form-control" name="meal3" placeholder="meal3">
                    <button type="submit" name="food" class="btn btn-primary me-3 mt-3">INTERACT</button>
                </form>
            </div>
            <?php } ?>

            <?php if($_SESSION['role'] == 'doctor') { 
                $sql = $conn->prepare("SELECT exercise, exercise_time, meal1, meal2, meal3, sleephour, bedtime, wakeup FROM users WHERE id = :userId");
                $sql->bindParam(':userId', $userId, PDO::PARAM_INT);
                $sql->execute();
                $patientData = $sql->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="input-form" id="exerciseForm">
                    <h1>Exercise Details</h1><hr>
                    <p>Exercise: <?php echo $patientData['exercise']; ?></p>
                    <p>Exercise Time: <?php echo $patientData['exercise_time']; ?></p>
            </div>

            <div class="input-form" id="foodForm">
                    <h1>Food Details</h1><hr>
                    <p>Meal 1: <?php echo $patientData['meal1']; ?></p>
                    <p>Meal 2: <?php echo $patientData['meal2']; ?></p>
                    <p>Meal 3: <?php echo $patientData['meal3']; ?></p>
            </div>

            <div class="input-form" id="sleepForm">
                    <h1>Sleep Details</h1><hr>
                    <p>Sleep Hours: <?php echo $patientData['sleephour']; ?></p>
                    <p>Bedtime: <?php echo $patientData['bedtime']; ?></p>
                    <p>Wake-up Time: <?php echo $patientData['wakeup']; ?></p>
            </div>

            </div>

            <?php } ?>
        </div>
    </center>
</div>        


    

 
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="main.js"></script>

</body>



    
</html>



