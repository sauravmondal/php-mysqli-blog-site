<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    // detect form submission
    if(isset($_POST["submit"])){
        
        $visible= $_POST["visible"];
        $id=$_POST["id"];

        //perform DB quqary

        $query  = "UPDATE comments SET ";
        $query .= "visible = '{$visible}' ";
        $query .= "WHERE id = '{$id}'";

        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        if($result && mysqli_affected_rows($connection)==1 || mysqli_affected_rows($connection)==0){
            //success
            $_SESSION["message"]="Comments updated";
            redirect_function ("manage_content.php");
        }
        else{
            //failure
            $_SESSION["message"]="Comments update failled";
            //die("Database query failed." . mysqli_error($connection));//find what the error was with mysqli_error(1)
            redirect_function ("update_post.php");
        }
    }
    else{
        redirect_function("update_post.php");
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