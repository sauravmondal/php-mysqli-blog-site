<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
  if(isset($_GET["post_id"])){
    $post_no=$_GET["post_id"];
  }
  else{
    //$post_no=null;
    redirect_function("manage_content.php");
  }
?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div>
  <?php echo session_message(); ?>
</div>
    
<div class="container">
	<div class="row">
		<div class="col-md-4">
      <h1>Manage Content</h1>
      <a href="manage_content.php">Manage Website Content</a>
		</div>

		<div class="col-md-8">
      <div class="sm">
        <h1>Approve Comments</h1>
      </div>

      <!-- Show post name -->
      <?php
        // 2. Perform database query
        $current_post=find_post_by_id($post_no);

        // 3. Use returned data (if any)
        $post_id=mysqli_fetch_assoc($current_post)
      ?>

      <div class="text-center">
        <?php echo "<h2>" .$post_id["post_name"] ."</h2> ". "<br>" ."(".$post_id["post_content"].")"; ?>
      </div>
      <!-- End Show post name -->

      <!-- Create New Comment -->
      <hr class="line">
      <h2>New Comment</h2>

      <form action="create_comment.php" method="post">

        <div class="form-floating">
        <textarea type="text" name="comment" value="" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
        <label for="floatingTextarea">Comments</label>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <!-- send $post_no variable -->
        <input type="hidden" name="post_id" value="<?php echo $post_no; ?>">

      </form>

      <!-- End Create New Comment -->

      <!-- Show All Comments -->

      <br>
      <hr class="line">
      <h2>All Comments</h2>

      <?php
        // 2. Perform database query
        $comments=find_comments_for_post($post_no, false); ?>

      <ul>      
        <?php
          // 3. Use returned data (if any)
          while($comment=mysqli_fetch_assoc($comments)){
            echo "<li>" . $comment["comment"] . "</li>";
        ?>
          <form action="update_comments.php" method="post">

            <div class="form-check">
              <input class="form-check-input" type="radio" name="visible" value="1" id="flexRadioDefault1"
                <?php if($comment["visible"]==1){echo "checked";} ?> >
              <label class="form-check-label" for="flexRadioDefault1">Visible</label>
              </div>

              <div class="form-check">
              <input class="form-check-input" type="radio" name="visible" value="0" id="flexRadioDefault2"
                <?php if($comment["visible"]==0){echo "checked";} ?>>
              <label class="form-check-label" for="flexRadioDefault2">Not Visible</label>
              </div>

              <input type="hidden" name="id" value="<?php echo $comment["id"]; ?>">
              <br>
              <button type="submit" name="submit" value="creat post" class="btn btn-primary">Submit Edit</button>
              <a href="delete_comments.php?comment_id=<?php echo urlencode($comment["id"]) ?>&post_id=<?php echo urlencode($post_id["id"]);?>"
              class="btn btn-danger">Delete</a>

          </form>
        <?php
          }
        ?>
        
      </ul>
      <!-- End Show All Comments -->
		</div>
	</div>
</div>
</body>

<?php
	// 4. Release returned data
	mysqli_free_result($current_post);
	mysqli_free_result($comments);
?>
<br>
<?php include("../includes/layouts/footer.php"); ?>

</html>
