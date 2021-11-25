<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
    // detect form submission
    if(isset($_POST["submit"])){

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

        //if error list is'n epmty because of storing the error message in the error list
        //if error list is'n epmty store the error message and redirect to the same(new_admin.php) page
        if(!empty($errors)){
            $_SESSION["errors"]=$errors;
            redirect_function ("new_admin.php");
        }

        //perform DB quqary
        $query = "INSERT INTO admins ( ";
        $query .= "username, hashed_password ";
        $query .= ") VALUES (";
        $query .="'{$username}', '{$password}' ";
        $query .=")";

        $result = mysqli_query($connection, $query);
        // Test if there was a query error
        if($result){
            //success
            $_SESSION["message"]="Admins created";
            
            // 5. Close database connection
            if(isset($connection)){
                mysqli_close($connection);
            }
            redirect_function ("manage_admins.php");
        }
        else{
            //failure
            $_SESSION["message"]="Admins creation failled";
            redirect_function ("manage_admins.php");
        }
    }
    // else{
    //     redirect_function("manage_admins.php");
    // }
?>

<!--  -->

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div>
    <?php echo session_message(); ?>
    <?php $errors = errors_message(); ?>
    <?php echo form_errors($errors); ?>
</div>

<div class="text-center">
  <h1>New Admin</h1>
</div>

<form action="new_admin.php" method="post">
    <div class="container">

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Username</label>
        <input type="text" name="username" value="" class="form-control" id="exampleFormControlInput1" placeholder="Username">
        </div>

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Password</label>
        <input type="password" name="password" value="" class="form-control" id="exampleFormControlInput1" placeholder="Password">
        </div>
        
        <br>
        <button type="submit" name="submit" value="creat post" class="btn btn-primary">Create Admin</button>  <a href="manage_admins.php">Cancel</a>

    </div>
</form>

<?php include("../includes/layouts/footer.php"); ?>
