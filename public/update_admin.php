<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
    // detect form submission
     if(isset($_POST["submit"])){
        
        $id=$_POST["id"];

        //Escape all string
        $username= mysqli_real_escape_string($connection, $_POST["username"]);
        $password= mysqli_real_escape_string($connection, $_POST["password"]);

        //Hashing password
        $password=password_hash($password, PASSWORD_DEFAULT);

        //validation_functions
        //validation for field can't be blank
        $fields_required=array("username", "password");
        validate_presence($fields_required);

        //validation for username and password can't be more than 10, 5(define as you want) chrecter
        $fields_with_max_lengths=array("username"=>"10", "password"=>"5");
        validate_max_lengths($fields_with_max_lengths);

        //validation for username and password can't be less than 5, 2(define as you want) chrecter
        $fields_with_min_lengths=array("username"=>"5", "password"=>"2");
        validate_min_lengths($fields_with_min_lengths);

        //error list empty na hole seasson e error message store korbe and redirect
        if(!empty($errors)){
            $_SESSION["errors"]=$errors;
            redirect_function ("edit_admin.php?admin_id={$id}");
        }

        //perform DB quqary

        $query  = "UPDATE admins SET ";
        $query .= "username = '{$username}', ";
        $query .= "hashed_password = '{$password}' ";
        $query .= "WHERE id = '{$id}'";

        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        if($result && mysqli_affected_rows($connection)==1 || mysqli_affected_rows($connection)==0){
            //success
            $_SESSION["message"]="Admin Updated";
            redirect_function ("manage_admins.php");
            //echo "success";
        }
        else{
            //failure
            $_SESSION["message"]="Admin Update failled";
            redirect_function ("manage_admins.php");
        }
    }
    else{
         redirect_function("manage_admins.php");
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