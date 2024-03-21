<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
	<script type="text/javascript">
		window.location = "login.php";
	</script>
<?php
}
$page = 'rbook';

include 'inc/connection.php';
mysqli_query($link,"UPDATE tbl_requests SET is_read='1' WHERE is_read='0'");
include 'inc/header.php';
?>
<!--dashboard area-->
<div class="dashboard-content">
	<div class="dashboard-header">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left">
						<p><span>dashboard</span>Admin Panel</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right text-right">
						<a href="dashboard.php"><i class="fas fa-home"></i>home</a>
						<span class="disabled">requested book</span>
					</div>
				</div>
			</div>
			<div class="issued-content">
				<div class="row">
					<div class="col-md-12">
						<div class="rbook-info status">
							<table id="dtBasicExample" class="table  table-striped table-dark text-center">
								<thead>
									<tr>
										<th>Name</th>
										<th>Book Name</th>
										<th>Availability</th>
										<th>Request Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$res = mysqli_query($link, "SELECT r.id, r.status, u.name, u.utype, b.books_name, b.books_availability, r.created_at FROM tbl_requests AS r 
										JOIN tbl_users AS u ON u.id = r.user_id 
										JOIN tbl_books AS b ON b.id = r.books_id
										ORDER BY r.id DESC;");
									while ($row = mysqli_fetch_array($res)) {
									?>
										<tr>
											<td><?php echo $row["name"]; ?></td>
											<td><?php echo $row["books_name"]; ?></td>
											<td><?php echo $row["books_availability"]; ?></td>
											<td><?php echo $row["created_at"]; ?></td>
											<td>
												<?php if ($row["status"] == 0) { ?>
													<a href="javascript:void(0)" class="btn btn-warning btn-xs">Pending</a>
												<?php } else if ($row["status"] == 1) { ?>
													<a href="javascript:void(0)" class="btn btn-success btn-xs">Approved</a>
												<?php } else { ?>
													<a href="javascript:void(0)" class="btn btn-danger btn-xs">Cancel</a>
												<?php } ?>
											</td>
											<td>
												<?php if($row["status"] == 0) { ?>
													<a href="approved-requested-books.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-xs"><i class="fas fa-check"></i></a>
													<a href="cancel-requested-books.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
												<?php } ?>
												<a href="delete-requested-books.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a></li>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>
<script>
	$(document).ready(function() {
		$('#dtBasicExample').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});
</script>