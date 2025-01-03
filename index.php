<?php

session_start();
    
require_once 'config.php';
    
if (!isset($_SESSION['role'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

    if ($_SESSION['role'] == 'user') {
        header('location: patient.php');
    }

    if (isset($_GET['home'])) {
        unset($_SESSION['success']);
        header('location: index.php');
        exit();
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
    <nav class="navbar">
        <div class="container">
    

        <a href="index.php?home=true">
                <img src="pg/home-icon.png" alt="Home Icon">
                <span>HOME</span>
        </a>
   

                <?php if($_SESSION['role'] == 'admin') { ?>
                    <a href="admin.php">
                    <img src="pg/role-icon.png" alt="role Icon">
                    <span>HOME</span>
                    </a>
                <?php } ?>

                    
                    <div class="size-btn">
                <form action="" method="post">
                    <a href="">
                    <button type="submit" name="logout" class="">
                    <img src="pg/logout-icon.png" alt="logout Icon">
                    <span>LOGOUT</span>
                    </button>
                    </a>
                </form>
                </div>

                <?php if(isset($_POST['logout'])){
                    header("location: signin.php");
                    unset($_SESSION['role']);
                } ?>
            </div>
            </div>
            </nav>

        <div class="container mt-5" style="width: 60%">
    <div class="search">
        <form action="details.php" method="POST" class="p-3" style="position: relative;">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control form-control-lg border-info rounded-0" placeholder="Search something..." autocomplete="off" required>
                <form action="index.phph" method="POST">
                    <div class="input-group-append">
                        <input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0">
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="list-group" style="position: absolute; width: 400px;" id="show-list"></div>
            </div>
        </form>
    </div>
    <?php if (isset($_SESSION['errorsearch'])) { ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $_SESSION['errorsearch']; 
                unset($_SESSION['errorsearch']);
            ?>

        </div>
    <?php } ?>
            
    </header>
    
    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'doctor') { ?>

    <center>
    <div class="user-list">
        <?php

if (!isset($_SESSION['success'])) {
    
    $query = $conn->prepare("SELECT * FROM users WHERE urole = 'user' ORDER BY id asc"); 
    $query->execute();
    
    if ($query->rowCount() > 0) {
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="border my-3 border-dark rounded p-5">
                <?php
                echo "ID :  " . $result['id'] . "<br>"; 
                echo "First name :  " . $result['firstname'] . "<br>";
                echo "Lastname :  " . $result['lastname'] . "<br>";
                echo "Email :  " . $result['email'] . "<br>";
                echo "Role :  " . $result['urole'] . "<br>";
                echo "Created_at :  " . $result['created_at'] . "<br><hr>";
                ?>

                
                <a href="patient.php?user_id=<?php echo $result['id']; ?>">
                <button type="button" class="btn btn-primary me-3">INTERACT</button>
                </a>
            </div>
        <?php }
    } else {
        echo "<p>No users found.</p>"; 
    }
    ?>
    
    <?php
}else{ 

    $ids = array_column($_SESSION['success'], 'id');
    $ids = implode(',', $ids);


    $query = $conn->prepare("SELECT * FROM users WHERE id IN ($ids) ORDER BY id asc");
    $query->execute();
    
    if ($query->rowCount() > 0) {
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="border my-3 border-dark rounded p-5">
                <?php
                echo "ID :  " . $result['id'] . "<br>"; 
                echo "First name :  " . $result['firstname'] . "<br>";
                echo "Lastname :  " . $result['lastname'] . "<br>";
                echo "Email :  " . $result['email'] . "<br>";
                echo "Role :  " . $result['urole'] . "<br>";
                echo "Created_at :  " . $result['created_at'] . "<br><hr>";
                ?>

                
                <a href="patient.php?user_id=<?php echo $result['id']; ?>">
                <button type="button" class="btn btn-primary me-3">INTERACT</button>
                </a>
            </div>
        <?php }
    } else {
        echo "<p>No users found.</p>"; 
    }
    ?>
      
    <?php } ?>

    
    </div>
    </center>
<?php } ?>


    

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="main.js"></script>
</body>



    
</html>