<?php
include_once("db_connect.php");

function redirect($path){
    ?>
    <script language="javascript">
        window.location.href = "<?php echo $path; ?>";
    </script>
    <?php
}

function executeQuery($query){
    global $mycon;
    if(!mysqli_query($mycon, $query)){
        return "Error: " . mysqli_error($mycon) . " Query: " . $query;
    } else {
        return true;
    }
}
?>
