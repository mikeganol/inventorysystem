<?php
include_once("../functions/functions.php");

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $custodian_id = $_POST['custodian_id'];
    $custodian_lastname = $_POST['custodian_lastname'];
    $custodian_firstname = $_POST['custodian_firstname'];
    $custodian_middlename = $_POST['custodian_middlename'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
   

    // Use prepared statement for update
    $query = "UPDATE tbl_custodian SET custodian_lastname=?, custodian_firstname=?, custodian_middlename=?,  age=? , gender=?  WHERE custodian_id=?";
    
    $stmt = $mycon->prepare($query);

    if (!$stmt) {
        die("Error in prepare statement: " . $mycon->error);
    }

    $stmt->bind_param("sssiss", $custodian_lastname, $custodian_firstname, $custodian_middlename, $age, $gender, $custodian_id);

    // Execute the update query
    if ($stmt->execute()) {
        // After successful update, redirect back to the member list page
        header("Location: customers_list.php");
        exit();
    } else {
        // Handle the update error
        echo "Error updating record: " . $stmt->error;
        // You might want to log the error, check your SQL query, etc.
    }

    $stmt->close();
}
?>
