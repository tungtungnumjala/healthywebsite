<?php
session_start();
require_once 'config.php';




$userId = $_GET['user_id'];  

  $sql = $conn->prepare("SELECT * FROM users WHERE id = :userId");
  $sql->bindParam(':userId', $userId, PDO::PARAM_INT); 
  $sql->execute();
  $row = $sql->fetch(PDO::FETCH_ASSOC);

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpdateUserInfo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <form action="updateform_db.php" method="post">

            <div class="container mt-5">

            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" name="id" aria-describedby="id" value="<?php echo $row['id']?>" readonly>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname" value="<?php echo $row['firstname']?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname" value="<?php echo $row['lastname']?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email" value="<?php echo $row['email']?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $row['password']?>">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" name="role" value="<?php echo $row['urole']; ?>">
            </div>
            <button type="submit" name="data_change" class="btn btn-primary">Submit</button>
            
            </div>
    </form>
    
</body>
</html>