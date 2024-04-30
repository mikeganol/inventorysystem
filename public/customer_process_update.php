<?php
include_once("../functions/functions.php");

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $customer_lastname = $_POST['customer_lastname'];
    $customer_firstname = $_POST['customer_firstname'];
    $customer_middlename = $_POST['customer_middlename'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
   

    // Use prepared statement for update
    $query = "UPDATE tbl_customers SET customer_lastname=?, customer_firstname=?, customer_middlename=?,  age=? , gender=?  WHERE customer_id=?";
    
    $stmt = $mycon->prepare($query);

    if (!$stmt) {
        die("Error in prepare statement: " . $mycon->error);
    }

    $stmt->bind_param("sssisi", $customer_lastname, $customer_firstname, $customer_middlename, $age, $gender, $customer_id);

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
