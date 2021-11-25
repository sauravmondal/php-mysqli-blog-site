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
  <h1>New Post</h1>
</div>

<form action="create_post.php" method="post">
    <div class="container">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Name</label>
            <input type="text" name="post_name" value="" class="form-control" id="exampleFormControlInput1" placeholder="Post Name">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Textarea</label>
            <textarea type="text" name="post_content" value="" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" value="1" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">Visible</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" value="0" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">Not Visible</label>
        </div>
        
        <br>
        <button type="submit" name="submit" value="creat post" class="btn btn-primary">Submit</button>
        <br>
        <a href="manage_content.php">Cancel</a>
    </div>
</form>

<?php include("../includes/layouts/footer.php"); ?>
