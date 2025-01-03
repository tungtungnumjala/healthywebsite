
<?php 

    session_start();
    require_once 'config.php';


    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: signin.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: signin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: signin.php");
        } else {
            try {
                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {
                    if ($email == $row['email'] && $password == $row['password']) {
                        
                        $_SESSION['id'] = $row['id']; 
                        $_SESSION['role'] = $row['urole'];

                        if ($row['urole'] == 'admin') {
                            header("location: index.php");
                            exit(); 
                        } elseif ($row['urole'] == 'user') {
                            header("location: patient.php");
                            exit(); 
                        } elseif ($row['urole'] == 'doctor') {
                            header("location: index.php");
                            exit(); 
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header("location: signin.php");
                        exit(); 
                    }
                } else {
                    $_SESSION['error'] = 'อีเมลผิด';
                    header("location: signin.php");
                    exit(); 
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    


?>