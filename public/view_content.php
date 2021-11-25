<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  if(isset($_GET["post_id"])){
    $post_no=$_GET["post_id"];
  }
  else{
    $post_no=null;
    redirect_function ("manage_content.php");
  }
?>
<?php confirm_logged_in(); ?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
    
<div class="container">
	<div class="row">
		<div class="col-md-4">
      <h1>Manage Content</h1>
      <br>
      <a href="manage_content.php"><?php echo htmlentities ("<< Manage Content")?></a>
      <br>
      <a href="edit_post.php?post_id=<?php echo urlencode($post_no)?>">Edit This Content</a>
		</div>

		<div class="col-md-8">
      <div class="sm">
        <h1>Manage Content</h1>
      </div>

      <?php
        // 2. Perform database query
        $current_post=find_post_by_id($post_no);
      ?>

      <?php
        // 3. Use returned data (if any)
        $post_id=mysqli_fetch_assoc($current_post);
      ?>

      <div class="text-center" id="sm2">
        <?php 
          echo $post_id["id"].". "."<h1>" .$post_id["post_name"] ."</h1> "."<br>".$post_id["post_content"];
        ?>
      </div>

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

      <br>
      <hr class="line">
      <h2>Comments</h2>
      
      <?php
        // 2. Perform database query
        $comments=find_comments_for_post($post_no, false);
      ?>
      
      <ul>
        <?php
          // 3. Use returned data (if any)
          while($comment=mysqli_fetch_assoc($comments)){
            echo "<li>" . $comment["comment"] . "</li>";
              if($comment["visible"]==1){
                echo "(visible)";
              }
              else {
                echo "(hide)";
              }
          }
        ?>
      </ul>
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