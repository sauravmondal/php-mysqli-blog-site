<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
    $id=$_GET["comment_id"];
    $post_id=$_GET["post_id"];
        // 2. Perform database query

        $query  = "DELETE FROM comments ";
        $query .= "WHERE id = '{$id}' ";
        $query .= "LIMIT 1";

        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        if($result && mysqli_affected_rows($connection) == 1){
            //success
            $_SESSION["message"]="Comment Delete";
            redirect_function ("approve_comments.php?post_id={$post_id}");
        }
        else{
            //failure
            $_SESSION["message"]=" Comment Delete failed";
            //die("Database query failed." . mysqli_error($connection));//find what the error was with mysqli_error(1)
            redirect_function ("approve_comments.php?post_id={$post_id}");
        }

?>