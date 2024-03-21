<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
	<script type="text/javascript">
		window.location = "login.php";
	</script>
<?php
}
$page = 'categories';

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
						<span class="disabled">Categories</span>
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
										<th>SL</th>
										<th>Category Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$res = mysqli_query($link, "SELECT * FROM tbl_categories ORDER BY id ASC;");
                                    $i=0;
									while ($row = mysqli_fetch_array($res)) {
                                        $i++;
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row["category_name"]; ?></td>
											<td>
												<?php if ($row["status"] == 0) { ?>
													<a href="javascript:void(0)" class="btn btn-warning btn-xs">Inactive</a>
												<?php } else { ?>
													<a href="javascript:void(0)" class="btn btn-success btn-xs">Active</a>
												<?php } ?>
											</td>
											<td>
												<a href="delete-category.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a></li>
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