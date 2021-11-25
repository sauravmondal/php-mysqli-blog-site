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
    
<div class="container">
  <div class="row" class="">
    <div class="col-md-4">
      <h1>Manage Admins</h1>
      <a href="admin.php"><?php echo htmlspecialchars("<<Admin menu")?></a>
      <br>
      <a href="manage_content.php">Manage Content</a>
      <br>
      <a href="logout.php" class="link-danger">Logout</a>
    </div>

    <div class="col-md-8" class="p">
      <div class="sm">
        <h1>Manage Admins</h1>
      </div>
      
      <br>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $results=find_all_admin();
          // 3. Use returned data (if any)
          while($admin_id=mysqli_fetch_assoc($results)){
          ?>
            <tr>
              <td><?php echo $admin_id["id"] ?> </td>
              <td><?php echo htmlentities($admin_id["username"]) ?></td>
              <td>
                <a href="edit_admin.php?admin_id=<?php echo $admin_id['id'] ?>"
                  class="mr-3" title="Update Admins" data-toggle="tooltip">Edit</a> &nbsp;
                  
                <a href="delete_admin_confirm.php?admin_id=<?php echo $admin_id['id'] ?>"
                  title="Delete Admins" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
              </td>
            </tr>
          <?php
          };
          ?>

          <?php
          // 4. Release returned data
          mysqli_free_result($results);    
          ?>

        </tbody>
      </table>

      <a href="new_admin.php" class="mr-3" title="View Record" data-toggle="tooltip">Add New Admin</a>
      <br>

    </div><!-- col-md-8 end -->
  </div><!-- row end -->
</div>  <!-- container end -->
</body>

<br>
<?php include("../includes/layouts/footer.php"); ?>

</html>