<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div class="bg_color">
  <?php echo session_message(); ?>
</div>
    
<div class="container">
	<div class="row" class="">
		<div class="col-md-4">
      <h1>Manage Content</h1>
      <a href="admin.php"><?php echo htmlspecialchars("<<Admin menu")?></a>
      <br>      
      <br>
      <a href="manage_admins.php">Manage Admin Users</a>
      <br>
      <a href="logout.php" class="link-danger">Logout</a>
		</div>

		<div class="col-md-8" class="p">
      <div class="sm">
        <h1>Manage Content</h1>
      </div>
      
      <div class="content_list" class="">
        <a href="new_post.php"><h3>New Post +</h3></a>
        <ul class="list-group">
          <?php
            // 2. Perform database query
            $posts=find_all_posts(false);
          ?>

          <?php
            // 3. Use returned data (if any)
            while($post_id=mysqli_fetch_assoc($posts)){
          ?>
          <!-- use here 2 diffrent style -->
          <li class="list-group-item">
            <a href="view_content.php?post_id=<?php echo urlencode($post_id["id"]) ?>" title="Read Post">
              <?php echo "<h4>".htmlentities($post_id["post_name"]) . "</h4>"; ?></a>

            <?php echo '<a href="delete_post.php?post_id='. urlencode($post_id['id']) .
                '" title="Delete Post" data-toggle="tooltip">|<span class="fa fa-trash"></span></a>|';?>

            <?php echo '<a href="edit_post.php?post_id='. urlencode($post_id['id']) .
                '" class="mr-3" title="Update Post" data-toggle="tooltip">|<span class="fa fa-pencil"></span>|</a>';?>
                
            <a href="approve_comments.php?post_id=<?php echo urlencode($post_id['id']);?>
                " class="mr-3" title="comment aproval" data-toggle="tooltip">
                  <?php echo htmlentities("|Approve Comments") ?><span class="fa fa-comments"></span></a>
          </li>

          <?php
          };
          ?>
          <?php
            // 4. Release returned data
            mysqli_free_result($posts);
          ?>
        </ul>
      </div>
		</div>
	</div>
</div>
</body>
<br>
<?php include("../includes/layouts/footer.php"); ?>
</html>