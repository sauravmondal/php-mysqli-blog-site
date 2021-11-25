<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    // detect form submission
    $post_id=$_GET["post_id"];

        // 2. Perform database query

        $query  = "DELETE FROM posts ";
        $query .= "WHERE id = '{$post_id}' ";
        $query .= "LIMIT 1";

        $result = mysqli_query($connection, $query);

        // Test if there was a query error
        //all comments will be deleted with post delete
        if($result && mysqli_affected_rows($connection) == 1){
            $query_comments  = "DELETE FROM comments ";
            $query_comments .= "WHERE post_id = '{$post_id}' ";
            mysqli_query($connection, $query_comments);

            //success
            $_SESSION["message"]="Post Delete";
            redirect_function ("manage_content.php");
        }
        else{
            //failure
            $_SESSION["message"]=" Delete failed";
            //die("Database query failed." . mysqli_error($connection));//find what the error was with mysqli_error(1)
            redirect_function ("delete_post.php?post_id={$post_id}");
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