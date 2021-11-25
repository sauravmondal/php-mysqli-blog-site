<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
    $username="";

    // detect form submission
    if(isset($_POST["submit"])){

        //validation_functions | test validation
        $fields_required=array("username", "password");
        validate_presence($fields_required);

        //if error list is'n epmty because of storing the error message in the error list
        //if error list is'n epmty store the error message and redirect to the same(login.php) page
        if(!empty($errors)){
            $_SESSION["errors"]=$errors;
            redirect_function ("login.php");
        }

        //Escape all string add leter
        $username= ($_POST["username"]);
        $password= ($_POST["password"]);

        //Test username/password combination
        $found_admin=atempt_login($username, $password);

        //store session message if found admin
        if($found_admin){
            //success session message
            $_SESSION["admin_id"]=$found_admin["id"];
            $_SESSION["username"]=$found_admin["username"];
            redirect_function("admin.php");
        }
        else{
            //failure session message
            $_SESSION["message"]="username/password combination invalid";
            redirect_function ("login.php");
        }
    }
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
  <h1>Login</h1>
</div>

<div class="container">
    <form action="login.php" method="post">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <input type="text" name="username" value="<?php echo htmlentities($username)?>" 
                class="form-control" id="exampleFormControlInput1" placeholder="Username">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="password" value="" class="form-control" id="exampleFormControlInput1" placeholder="Password">
        </div>
        
        <br>
        <button type="submit" name="submit" value="creat post" class="btn btn-primary">Submit</button>  <a href="index.php">Cancel</a>

    </form>
</div>

<?php include("../includes/layouts/footer.php"); ?>