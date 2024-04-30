<?php
include_once("../functions/functions.php");

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $item_id= $_POST['item_id'];
    $customer_id = $_POST['customer_id'];
    $custodian_id = $_POST['custodian_id'];
    $transaction_type = $_POST['transaction_type'];
    $status = $_POST['status'];
    $date = $_POST['date'];
   

    // Use prepared statement for update
    $query = "UPDATE tbl_transaction SET item_id=?, customer_id=?, custodian_id=?,  transaction_type=? , status=?, date=? WHERE transaction_id=?";
    
    $stmt = $mycon->prepare($query);

    if (!$stmt) {
        die("Error in prepare statement: " . $mycon->error);
    }

    $stmt->bind_param("iiissis", $item_id, $customer_id, $custodian_id, $transaction_type, $status, $date, $customer_id);

    // Execute the update query
    if ($stmt->execute()) {
        // After successful update, redirect back to the member list page
        header("Location: transaction_list.php");
        exit();
    } else {
        // Handle the update error
        echo "Error updating record: " . $stmt->error;
        // You might want to log the error, check your SQL query, etc.
    }

    $stmt->close();
}
?>
