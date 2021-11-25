<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
    
<?php
  if(isset($_GET["post_id"])){
    $post_no=$_GET["post_id"];
  }
  else{
    $post_no=null;
  }
?>

<div>
    <?php echo session_message(); ?>
</div>

<!-- step 2 & 3 query and return data by {find_post_by_id_2} this function -->

<?php $post_id=find_post_by_id_2($post_no);?>

<div class="alert alert-primary" role="alert">
  <div class="text-center">
    <?php echo "<h1>".$post_id["id"].". ".$post_id["post_name"] . "</h1> ";?>
    <br>
    <br>
    <h4>Do you want to Delete This Post?</h4>
    <p class="text-danger">It will also Delete all the comments of this post</p>
    <br>
    <a href="delete_post_confirm.php?post_id=<?php echo urlencode($post_id["id"]) ?>"
        type="button" name="submit"class="btn btn-danger">Delete Post</a>
  </div>
</div>


<?php include("../includes/layouts/footer.php"); ?>
