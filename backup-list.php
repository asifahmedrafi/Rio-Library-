<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
	<script type="text/javascript">
		window.location = "login.php";
	</script>
<?php
}
$page = 'backuplist';

include 'inc/connection.php';
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
						<span class="disabled">DB Backup List</span>
					</div>
				</div>
			</div>
			<div class="issued-content">
				<div class="row">
					<div class="col-md-12">
						<div class="rbook-info status">
							<table id="dtBasicExample" class="table table-striped table-dark text-center">
								<thead>
									<tr>
										<th>SL</th>
										<th>File Name</th>
										<th>Bacup Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$res = mysqli_query($link, "SELECT * FROM tbl_files ORDER BY id ASC;");
                                    $i=0;
									while ($row = mysqli_fetch_array($res)) {
                                        $i++;
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row["name"]; ?></td>
											<td><?php echo $row["created_at"]; ?></td>
											<td>
												<a href="delete-backup.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a></li>
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