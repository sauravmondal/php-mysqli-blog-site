<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    // detect form submission
    $admin_id=$_GET["admin_id"];
        // 2. Perform database query

        $query  = "DELETE FROM admins ";
        $query .= "WHERE id = '{$admin_id}' ";
        $query .= "LIMIT 1";

        $result = mysqli_query($connection, $query);

        // Test if there was a query error

        if($result && mysqli_affected_rows($connection) == 1){
            //success
            $_SESSION["message"]="Admin Deleted";
            redirect_function ("manage_admins.php");
        }
        else{
            //failure
            $_SESSION["message"]="Admin Delete failed";
            redirect_function ("delete_admin_confirm.php?admin_id={$admin_id}");
        }
    
?>

<?php
    // 4. Release returned data
    mysqli_free_result($result);

    // 5. Close database connection
    if(isset($connection)){
        mysqli_close($connection);
    }
?>