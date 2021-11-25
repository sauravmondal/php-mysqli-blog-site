<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php $a="public"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div>
    <?php echo session_message(); ?>
</div>
    
<div class="container">
	<div class="row">
		<div class="col-md-4">
            <h1>Navigation</h1>
            <a href="login.php">Login</a>            
		</div>

		<div class="col-md-8">
        	<h1>Post List</h1>

                <?php
                    // 2. Perform database query
                    $posts=find_all_posts();
                ?>
                <?php
                    // 3. Use returned data (if any)
                    while($post_id=mysqli_fetch_assoc($posts)){
                ?>

                    <div class="border border-secondary">
                        <a href="post.php?post_id=<?php echo urlencode($post_id["id"]) ?>">
                        <?php echo "<h4>".htmlentities($post_id["post_name"]) . "</h4>"; ?></a>

                        <p><?php echo htmlentities($post_id["post_content"]); ?></p>
                    </div>
                    <br>

                <?php
                };
                ?>
                <?php
                    // 4. Release returned data
                    mysqli_free_result($posts);
                ?>

		</div>
	</div>
</div>
</body>

<?php include("../includes/layouts/footer.php"); ?>

</html>
