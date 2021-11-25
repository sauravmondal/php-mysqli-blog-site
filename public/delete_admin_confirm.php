<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
    
<?php
  if(isset($_GET["admin_id"])){
    $admin_id=$_GET["admin_id"];
  }
  else{
    $admin_id=null;
  }
?>

<div>
    <?php echo session_message(); ?>
</div>

<!-- step 2 & 3 query and return data by {find_post_by_id_2} this function -->
<?php $admin_id=find_admin_by_id($admin_id);?>

<div class="alert alert-primary" role="alert">
  <div class="text-center">
    <?php echo "<h1>"."Admin No.".$admin_id["id"].". ".$admin_id["username"] . "</h1> ";?>
    <br>
    <br>
    <h4>Do you want to Delete This Admin?</h4>
    <br>
    <a href="delete_admin.php?admin_id=<?php echo urlencode($admin_id["id"]) ?>"
        type="button" name="submit"class="btn btn-danger">Delete Admin</a>
  </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>
