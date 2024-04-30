<?php
include_once("../functions/functions.php");

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    
   

    // Use prepared statement for update
    $query = "UPDATE tbl_users SET name=?, username=?, password=?, user_type=?  WHERE user_id=?";
    
    $stmt = $mycon->prepare($query);

    if (!$stmt) {
        die('Error in prepare statement: ' . $mycon->error);
    }

    $stmt->bind_param("ssssi", $name, $username, $password, $user_type, $user_id);

    // Execute the update query
    if ($stmt->execute()) {
        // After successful update, redirect back to the member list page
        header("Location: user_list.php");
        exit();
    } else {
        // Handle the update error
        echo "Error updating record: " . $stmt->error;
        // You might want to log the error, check your SQL query, etc.
    }

    $stmt->close();
}
?>
