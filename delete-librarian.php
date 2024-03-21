<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		?>
			<script type="text/javascript">
				window.location="login.php";
			</script>
		<?php
	}  
         
	include 'inc/connection.php';
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		mysqli_query($link, "delete from tbl_librarians where id=$id");
		?>
		<script type="text/javascript">
			window.location="all-librarian-info.php";
		</script>
		<?php
	}
	else{
		?>
		<script type="text/javascript">
			window.location="all-librarian-info.php";
		</script>
		<?php
	}


 ?>