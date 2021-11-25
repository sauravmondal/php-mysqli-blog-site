<footer id="footer">
<p> @ <?php echo date ("Y"); ?> Hello World copyright</p>
</footer>

<?php
  // 5. Close database connection
  if(isset($connection)){
	mysqli_close($connection);
}
?>