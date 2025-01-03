<?php

session_start();
require_once 'config.php'; // Include your PDO database connection file

if (isset($_POST['submit'])) {
    try {

        $search = $_POST['search']; // Prepare the search term with wildcard characters
        $sql = "SELECT id FROM users WHERE firstname LIKE :search AND urole = 'user' LIMIT 10";

        $stmt = $conn->prepare($sql); // Use the PDO prepare method
        $stmt->bindParam(':search', $search, PDO::PARAM_STR); // Bind the parameter
        $stmt->execute(); // Execute the query
        echo $search;

        $data = [];
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array   
            $_SESSION['success'] = $data; 
        }else{
            $_SESSION['errorsearch'] = "No users found.";
        }
        

        echo json_encode($data);
        

    } catch (PDOException $e) {
        // Handle any errors
        echo json_encode(['error' => $e->getMessage()]);
    }
    header("location: index.php");

}
?>
