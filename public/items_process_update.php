<?php
include_once("../functions/functions.php");

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_type = $_POST['item_type'];
    $quantity = $_POST['quantity'];
    $item_condition = $_POST['item_condition'];
    
   

    // Use prepared statement for update
    $query = "UPDATE tbl_items SET item_name=?, item_type=?, quantity=?, item_condition=? WHERE item_id=?";
    
    $stmt = $mycon->prepare($query);

    if (!$stmt) {
        die("Error in prepare statement: " . $mycon->error);
    }

    $stmt->bind_param("ssisi", $item_name, $item_type, $quantity, $item_condition, $item_id);

    // Execute the update query
    if ($stmt->execute()) {
        // After successful update, redirect back to the member list page
        header("Location: item_list.php");
        exit();
    } else {
        // Handle the update error
        echo "Error updating record: " . $stmt->error;
        // You might want to log the error, check your SQL query, etc.
    }

    $stmt->close();
}
?>
