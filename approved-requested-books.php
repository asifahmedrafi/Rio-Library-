<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		header('Location: login.php');
	}  
         
	include 'inc/connection.php';
	if (isset($_GET["id"])) {
		$id = $_GET["id"];

		$query = "SELECT * FROM tbl_requests WHERE id='$id' LIMIT 1";
		$result = mysqli_query($link, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);

			$query2 = "SELECT * FROM tbl_books WHERE id=$row[books_id] LIMIT 1";
			$result2 = mysqli_query($link, $query2);

			if($result2) {
				$book = mysqli_fetch_assoc($result2);

				if($book['books_availability'] > 0) {
					mysqli_query($link,"UPDATE tbl_books SET books_availability = books_availability - 1 WHERE id = '$book[id]'");
					
					$user_id = $row['user_id'];
					$books_id = $row['books_id'];

					$issued_date = date("Y-m-d");
					$return_date = date("Y-m-d", strtotime($issued_date . " +29 days"));

					$issued_by = $_SESSION["user_id"];
					$issued_utype = $_SESSION["utype"];

					mysqli_query($link,"UPDATE tbl_requests SET status='1', approved_by='$issued_by', approved_utype='$issued_utype', approved_at='$issued_date', updated_at='$issued_date' WHERE id='$id'");
					$sql = mysqli_query($link, "INSERT INTO tbl_issues (user_id, books_id, return_date, issued_by, issued_utype,request_id) VALUES ('$user_id', '$books_id', '$return_date', '$issued_by', '$issued_utype','$id')");

					if($sql){
						$message = "Book Request Approved & Successfully Issued";
						header("Location: issued-books.php?message=" . urlencode($message));
					}
				} else { 
					$message = "Books Not Availability!";
					header("Location: requested-books.php?message=" . urlencode($message));
				}
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