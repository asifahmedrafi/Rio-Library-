<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php
            </script>
        <?php
    }
    include 'inc/header.php';
    include 'inc/connection.php';
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
							<span class="disabled">tbl_fines</span>
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
                                                <th>Name</th>
                                                <th>Book Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                           <?php
                                            $res = mysqli_query($link, "SELECT 
                                                                                 f.id, 
                                                                                 f.status, 
                                                                                 f.total_fine as fine, 
                                                                                 f.pay_date, 
                                                                                 u.name, 
                                                                                 u.utype, 
                                                                                 b.books_name 
                                                                             FROM tbl_fines AS f 
                                                                             JOIN tbl_users AS u ON u.id = f.user_id 
                                                                             JOIN tbl_books AS b ON b.id = f.books_id
                                                                             ORDER BY f.id DESC;");
                                             while ($row = mysqli_fetch_array($res)) { ?>
                                                    <tr>
                                                        <td> <?php echo $row["name"]; ?></td>
                                                        <td> <?php echo $row["books_name"]; ?></td>
                                                        <td> <?php echo $row["fine"]; ?></td>
                                                        
                                                        <td>
                                                            <?php if($row["status"] == 0) {?>
                                                                <a href="javascript:void(0)" class="btn btn-warning btn-xs">Pending</a>
                                                            <?php } else { ?>
                                                                <a href="javascript:void(0)" class="btn btn-success btn-xs">Payment</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if($row["pay_date"] == null) { ?>
                                                                <a href="payments.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-xs">Pay Now</a>
                                                            <?php } else { ?>
                                                                <a href="money-receipt.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-xs">Money Receipt</a>
                                                            <?php } ?>
                                                            <a href="delete-fine.php?id=<?php echo $row["id"]; ?> " class="btn btn-danger btn-xs">Delete</a>
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
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>