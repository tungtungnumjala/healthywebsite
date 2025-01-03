<?php 
    session_start();
    require_once 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User information</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php $query = $conn->prepare("SELECT * FROM users ORDER BY id asc"); 
          $query->execute();
          
    ?>
    <div class="container " style="margin-top:60px;" >

    <?php if(isset($_SESSION['change_success'])) { ?>
    <div class="border my-3 border-green rounded p-5 text-center">  
    <?php 
    echo isset($_SESSION['change_success']) ? $_SESSION['change_success'] : ' '; 
    unset($_SESSION['change_success']); 
    ?>
    </div>
    <?php } ?>

  <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="border my-3 border-dark rounded p-5">
      <?php
        echo "ID :  " . $result['id'] . "<br>";
        echo "First name :  " . $result['firstname'] . "<br>";
        echo "Lastname :  " . $result['lastname'] . "<br>";
        echo "Email :  " . $result['email'] . "<br>";
        echo "Role :  " . $result['urole'] . "<br>";
        echo "Created_at :  " . $result['created_at'] . "<br>";
      ?>

      <a href="updateform.php?user_id=<?php echo $result['id']; ?>">
        <button type="button" class="btn btn-primary float-end me-3">Edit</button>
      </a>

      
      <a href="delete.php?user_id=<?php echo $result['id']; ?>">
      <button type="button" name="delete" class="btn btn-primary float-end me-5">Delete</button>
      </a>
      
    </div>
  <?php } ?>
</div>



    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="main.js"></script>
</body>
</html>