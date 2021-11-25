<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  if(isset($_GET["post_id"])){
    $post_no=$_GET["post_id"];

    //step 2 & 3
    $post_id=find_post_by_id_2($post_no);
  }

  if(!isset($_GET["post_id"]) || $post_id["visible"]==0){
    $post_no=null;
    redirect_function ("index.php");
  }
?>

<?php include("../includes/layouts/header.php"); ?>

<?php echo session_message(); ?>
    
<div class="container">
	<div class="row">
		<div class="col-md-4">
      <h1>Manage Content</h1>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
		</div>

		<div class="col-md-8">
      <h1>Manage Content</h1>

      <div class="text-center">
        <?php echo "<h1>" .htmlentities($post_id["post_name"]) ."</h1> ". "<br>" 
              ."(".nl2br(htmlentities($post_id["post_content"])).")"; ?>
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
        <!-- send hidden $post_no variable -->
        <input type="hidden" name="post_id" value="<?php echo $post_no; ?>">
        <input type="hidden" name="public" value="<?php //echo $public; ?>">

      </form>

      <br>
      <hr class="line">
      <h2>Comments</h2>
      <?php
        // 2. Perform database query
        $comments=find_comments_for_post($post_no);
      ?>
      <ul>
        <?php
          // 3. Use returned data (if any)
          while($comment=mysqli_fetch_assoc($comments)){
            echo "<li>" . $comment["comment"] . "</li>";
          }
        ?>
      </ul>
		</div>
	</div>
  
</div>
</body>

<?php
	// 4. Release returned data
	//mysqli_free_result($post_no);
	mysqli_free_result($comments);
?>
<br>
<?php include("../includes/layouts/footer.php"); ?>

</html>
