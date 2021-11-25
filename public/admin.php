<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php $a="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
    
    <div class="container">
		<div class="row">
			<div class="col-md-4">
				<div id="page">
                    <h1>Admin menu</h1>
                    <p>welcome to the admin area,<?php echo " ". htmlentities($_SESSION["username"])?></p>
                    <ul>
                        <li><a href="manage_content.php">Manage Website Content</a></li>
                        <li><a href="manage_admins.php">Manage Admin Users</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
			</div>
			<div class="col-md-8">
                <h3>Hello</h3>
                <p>welcome to the admin area,<?php echo " ". htmlentities($_SESSION["username"])?></p>
			</div>
		</div>
	</div>
</bodsy>

<?php include("../includes/layouts/footer.php"); ?>

</html>