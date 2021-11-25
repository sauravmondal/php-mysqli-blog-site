<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
  if(isset($_GET["admin_id"])){
    $admin_no=$_GET["admin_id"];
  }
  else{
    $admin_no=null;
    $_SESSION["message"]= "Please select A Admin for Update";
    redirect_function("manage_admins.php");
  }
?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div>
  <?php echo session_message(); ?>
  <?php $errors = errors_message(); ?>
  <?php echo form_errors($errors); ?>
</div>

<div class="text-center">
  <h1>Update Admin</h1>
</div>


  <!-- step 2 & 3 query and return data by {find_post_by_id_2} this function -->
  <?php $admin_id=find_admin_by_id($admin_no);?>

    <form action="update_admin.php" method="post">
      <div class="container">

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Username</label>
          <input type="text" name="username" value="<?php echo $admin_id["username"]?>" class="form-control" id="exampleFormControlInput1" placeholder="Post Name">
        </div>
      
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Password</label>
          <input type="password" name="password" value="" class="form-control" id="exampleFormControlTextarea1">
        </div>

        <br>
        <button type="submit" name="submit" value="creat post" class="btn btn-primary">Submit Edit</button>

        <input type="hidden" name="id" value="<?php echo $admin_no; ?>">

      </div>
    </form>
    <br>
    
    <div class="container">
      <a href="manage_admins.php">Cancel</a>
    </div>

<?php include("../includes/layouts/footer.php"); ?>