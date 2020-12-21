<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
?>

<?php
  include_once 'header.php';
?>

		<section class="ftco-section">
    	<div class="container">
    		<div class="row d-md-flex">
          <?php include("core.php"); ?>
		    </div>
    	</div>
    </section>

<?php
  include_once 'footer.php';
?>