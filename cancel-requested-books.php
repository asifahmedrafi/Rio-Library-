<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		header('Location: login.php');
	}  
         
	include 'inc/connection.php';
	if (isset($_GET["id"])) {
		$id = $_GET["id"];

		$result = mysqli_query($link, "SELECT * FROM tbl_requests WHERE id='$id' LIMIT 1");

		if ($result) {
			$row = mysqli_fetch_assoc($result);

			$user_id = $row['user_id'];
			$books_id = $row['books_id'];

			$cancel_date = date("Y-m-d");

			$cancel_by = $_SESSION["user_id"];
			$cancel_utype = $_SESSION["utype"];

			if($row["status"]==1) {
				$result2 = mysqli_query($link, "SELECT * FROM tbl_books WHERE id=$row[books_id] LIMIT 1");

				if($result2) {
					$book = mysqli_fetch_assoc($result2);
					mysqli_query($link,"UPDATE tbl_books SET books_availability = books_availability + 1 WHERE id = '$book[id]'");
					
					

					mysqli_query($link,"UPDATE tbl_requests SET status='2', cancel_by='$cancel_by', cancel_utype='$cancel_utype', cancel_at='$cancel_date', updated_at='$cancel_date' WHERE id='$id'");
					$sql = mysqli_query($link, "delete from tbl_issues where request_id=$id");

					if($sql){
						$message = "Book Request Cancel";
						header("Location: requested-books.php?message=" . urlencode($message));
					}
				}
			} else {
				$sql = mysqli_query($link,"UPDATE tbl_requests SET status='2', cancel_by='$cancel_by', cancel_utype='$cancel_utype', cancel_at='$cancel_date', updated_at='$cancel_date' WHERE id='$id'");
				$message = "Book Request Cancel";
				header("Location: requested-books.php?message=" . urlencode($message));
			}
		} else {
			echo "No rows found.";
		}
	} else {
		?>
		<script type="text/javascript">
			window.location="requested-books.php";
		</script>
		<?php
	}
 ?>