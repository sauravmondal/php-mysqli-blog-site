<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
    // detect form submission
    if(isset($_POST["submit"])){
        //store $_POST values into a local veriable
        $visible= $_POST["visible"];

        //Escape all string
        $post_name= mysqli_real_escape_string($connection, $_POST["post_name"]);
        $post_content= mysqli_real_escape_string($connection, $_POST["post_content"]);

        //validation_functions
        //validation for field can't be blank
        $fields_required=array("post_name", "post_content");
        validate_presence($fields_required);
        //validation for post name can't be more than 10(define as you want) chrecter
        $fields_with_max_lengths=array("post_name"=>"10");
        validate_max_lengths($fields_with_max_lengths);
        //validation for post name can't be less than 5(define as you want) chrecter
        $fields_with_min_lengths=array("post_name"=>"5");
        validate_min_lengths($fields_with_min_lengths);

        //validation functions array (it should be empty for further code execution)

        if(!empty($errors)){
            $_SESSION["errors"]=$errors;
            redirect_function ("new_post.php");
        }
        //if errors are empty/no errors then run query for DB insertion
        $query = "INSERT INTO posts ( ";
        $query .= "post_name, post_content, visible";
        $query .= ") VALUES (";
        $query .="'{$post_name}', '{$post_content}', '{$visible}'";
        $query .=")";

        $result = mysqli_query($connection, $query);
        // Test if there was a query error (add leter)

        if($result){
            //success session message
            $_SESSION["message"]="Post created";
            redirect_function ("manage_content.php");
        }
        else{
            //failure session message
            $_SESSION["message"]="Post creation failled";
            redirect_function ("new_post.php");
        }

    }
    else{
        redirect_function("new_post.php");
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