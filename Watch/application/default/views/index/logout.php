<?php  
	session_start();
	if (isset($_SESSION['email'])) {
	  	//Hủy SESSION và điều hướng về login.php
	  	unset($_SESSION['email']);
	  	?>
	  	<script>
            window.location = "<?php echo URL_BASE;?>";
        </script>
	  	<?php
	}
?>