<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div>
    <?php echo session_message(); ?>
    <?php $errors = errors_message(); ?>
    <?php echo form_errors($errors); ?>
</div>

<div class="text-center">
  <h1>Update Post</h1>
</div>

<?php
  if(isset($_GET["post_id"])){
    $post_no=$_GET["post_id"];
  }
  else{
    $post_no=null;
    echo "Please select A Page for Update";
    echo "<br>";
    //redirect_function("edit_post.php");
  }
?>
  <!-- step 2 & 3 query and return data by {find_post_by_id_2} this function -->
<?php $post_id=find_post_by_id_2($post_no);?>

<form action="update_post.php" method="post">

  <div class="container">

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Post Name</label>
        <input type="text" name="post_name" value="<?php echo $post_id["post_name"]?>" class="form-control" id="exampleFormControlInput1" placeholder="Post Name">
    </div>

    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Post Content</label>
      <input type="text" name="post_content" value="<?php echo $post_id["post_content"]?>" class="form-control" id="exampleFormControlTextarea1" rows="3">
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="visible" value="1" id="flexRadioDefault1"
      <?php if($post_id["visible"]==1){echo "checked";} ?> >
      <label class="form-check-label" for="flexRadioDefault1">Visible</label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="visible" value="0" id="flexRadioDefault2"
      <?php if($post_id["visible"]==0){echo "checked";} ?>>
      <label class="form-check-label" for="flexRadioDefault2">Not Visible</label>
    </div>
        
    <br>
    <button type="submit" name="submit" value="creat post" class="btn btn-primary">Submit Edit</button>
    <br>
    <a href="manage_content.php">Cancel</a>

    <input type="hidden" name="id" value="<?php echo $post_no; ?>">

  </div>

</form>

<?php include("../includes/layouts/footer.php"); ?>