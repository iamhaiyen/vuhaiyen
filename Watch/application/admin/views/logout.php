<?php  
	session_start();
	if (isset($_SESSION['emailAdmin'])) {
	  	//Hủy SESSION và điều hướng về login.php
	  	unset($_SESSION['emailAdmin']);
	  	?>
	  	<script>
            window.location = "<?php echo URL_BASE;?>admin/login";
        </script>
	  	<?php
	}else{
		?>
	  	<script>
            window.location = "<?php echo URL_BASE;?>admin/login";
        </script>
	  	<?php
	}  
?>