<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php
            </script>
        <?php
    }
    $page = 'ibook';
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
							<span class="disabled">issued book</span>
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
                                                <th>Books Name</th>
                                                <th>Issue Date</th>
                                                <th>Return Date</th>
                                                <th>Name</th>
                                                <th>Return Status</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                        <tbody>
                                            <?php 
                                                // $res= mysqli_query($link, "select * from tbl_issues");

                                                $res= mysqli_query($link, "SELECT i.id, i.issued_date, i.return_date, i.actual_return_date, u.name, u.utype, b.books_name, b.books_availability FROM tbl_issues AS i 
                                                JOIN tbl_users AS u ON u.id = i.user_id 
                                                JOIN tbl_books AS b ON b.id = i.books_id
                                                ORDER BY i.id DESC;");

                                                while ($row=mysqli_fetch_array($res)) { ?>
                                                    <tr>
                                                        <td> <?php echo $row["books_name"]; ?></td>
                                                        <td> <?php echo $row["issued_date"]; ?></td>
                                                        <td> <?php echo $row["return_date"]; ?></td>
                                                        <td> <?php echo $row["name"]; ?></td>
                                                        <td> 
                                                            <?php if($row["actual_return_date"]!=null) {?>
                                                                <a class="btn btn-success btn-xs no-pointer" href="javascript:void(0)">Return</a>
                                                            <?php } else { ?> 
                                                                <a class="btn btn-warning btn-xs no-pointer" href="javascript:void(0)">No Return</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li><a style="color: #fff;" href="return.php?id=<?php echo $row["id"]; ?>" title="Return Books"><i class="fas fa-undo-alt"></i></a></li>
                                                                <li><a href="delete.php?id=<?php echo $row["id"]; ?>"><i class="fas fa-trash"></i></a></li>
                                                            </ul> 
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