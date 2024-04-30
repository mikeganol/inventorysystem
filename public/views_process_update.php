<?php
include_once("../functions/functions.php");

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $customer_lastname = $_POST['customer_lastname'];
    $customer_firstname = $_POST['customer_firstname'];
    $customer_middlename = $_POST['customer_middlename'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $custodian_lastname = $_POST['custodian_lastname'];
    $customer_firstname = $_POST['customer_firstname'];
    $customer_middlename = $_POST['customer_middlename'];
    $date = $_POST['date'];
   

    // Use prepared statement for update
    $query = "UPDATE view_transaction_logs SET customer_lastname=?, customer_firstname=?, customer_middlename=?,  item_name=? , quantity=?, custodian_lastname=?, custodian_firstname=?, custodian_middlename=?, date=? WHERE transaction_id=?";
    
    $stmt = $mycon->prepare($query);

    if (!$stmt) {
        die("Error in prepare statement: " . $mycon->error);
    }

    $stmt->bind_param("ssssisssi", $customer_lastname, $customer_firstname, $customer_middlename, $item_name, $quantity,$custodian_lastname, $custodian_firstname, $customer_middlename, $date);

    // Execute the update query
    if ($stmt->execute()) {
        // After successful update, redirect back to the member list page
        header("Location: views_list.php");
        exit();
    } else {
        // Handle the update error
        echo "Error updating record: " . $stmt->error;
        // You might want to log the error, check your SQL query, etc.
    }

    $stmt->close();
}
?>
