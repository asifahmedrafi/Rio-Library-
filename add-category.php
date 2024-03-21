<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
    <script type="text/javascript">
        window.location = "login.php";
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
                        <span class="disabled">add category</span>
                    </div>
                </div>
            </div>
            <div class="bstore">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="category_name" placeholder="Category Name" required="">
                            </td>
                        </tr>
                    </table>
                    <div class="submit mt-20">
                        <input type="submit" name="submit" class="btn btn-info submit" value="Add Category">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit"])) {
    $result = mysqli_query($link, "insert into tbl_categories (category_name) values('$_POST[category_name]')");
    if($result) {
        header('location: display-category.php');
    }
}
?>

<?php
include 'inc/footer.php';
?>