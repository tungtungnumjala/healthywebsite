<?php 


    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const DBPASS = '';
    const DBNAME = 'register_db';


    //กำหนดตัวเเปร dsn ซึ่งเอาไว้เชื่อมกับ SQL
    $dsn = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME . '';
    $conn = null;

    //use PDO for connect to SQL with variables DBUSER and DBPASS
    try {
        $conn = new PDO($dsn, DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Error : " . $e->getMessage());
    }



?>