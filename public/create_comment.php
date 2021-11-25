<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    // detect form submission
    if(isset($_POST["submit"])){
        
        $visible= (int) 0;

        //Escape all string
        $comment= mysqli_real_escape_string($connection, $_POST["comment"]);
        $post_id= mysqli_real_escape_string($connection, $_POST["post_id"]);

        //perform DB quqary

        $query = "INSERT INTO comments ( ";
        $query .= "post_id, comment, visible";
        $query .= ") VALUES (";
        $query .="'{$post_id}', '{$comment}', '{$visible}'";
        $query .=")";

        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        if($result){
            //success session message
            $_SESSION["message"]="comment created, Waiting for Admin aproval";
            if(isset($_POST["public"])){
                redirect_function ("index.php");
            }
            redirect_function ("manage_content.php");            
        }
        else{
            //failure session message
            $_SESSION["message"]="comment creation failled";
            redirect_function ("view_content.php");
        }
    }
    else{
        if(isset($_POST["public"])){
            redirect_function ("index.php");
        }
        redirect_function("view_content.php");
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