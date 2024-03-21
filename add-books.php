<?php 
session_start();
if (!isset($_SESSION["username"])) {
    ?>
        <script type="text/javascript">
            window.location="login.php";
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
                        <span class="disabled">add book</span>
                    </div>
                </div>
            </div>
            <div class="bstore">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="booksname" placeholder="Books name*" required=""> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                $categories = mysqli_query($link, "SELECT * FROM tbl_categories WHERE status='1' ORDER BY id ASC;");
                                ?>
                                <select name="category" id="category" class="form-control" required="">
                                    <option value="">Select Category*</option>
                                    <?php foreach($categories as $category) { ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
                                    <?php } ?>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Books image* (File size: minimum 1MB, maximum 10MB, Format: JPG)
                                <input type="file" class="form-control" name="f1" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="isbn_no" placeholder="ISBN No.*" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bauthorname" placeholder="Books author name*" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bpubname" placeholder="Books publication name*" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" class="form-control" name="bpurcdate" placeholder="Books purchase date*" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bprice" placeholder="Books price*" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bquantity" placeholder="Books quantity*" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bavailability" placeholder="Books availability*" required="">
                            </td>
                        </tr>
                    </table>
                    <div class="submit mt-20">
                        <input type="submit" name="submit" class="btn btn-info submit" value="Add Book">
                    </div>
                </form>
            </div>				
        </div>					
    </div>
</div>

<?php

if (isset($_POST["submit"])) {

    $image_name = $_FILES['f1']['name'];
    $image_size = $_FILES['f1']['size'];
    $image_temp = $_FILES['f1']['tmp_name'];
    $image_type = $_FILES['f1']['type'];

    // Check if the image format is JPG
    if ($image_type != 'image/jpeg') {
        ?>
        <script type="text/javascript">
            alert("Please upload an image in JPG format.");
        </script>
        <?php
        exit;
    }

    // Check if the image size is within the specified range
    if ($image_size < 1048576 || $image_size > 10485760) {
        ?>
        <script type="text/javascript">
            alert("Please upload an image between 1MB and 10MB in size.");
        </script>
        <?php
        exit;
    }

    $temp = explode(".", $image_name);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $imagepath = "books-image/" . $newfilename;
    move_uploaded_file($image_temp, $imagepath);

    $isbn_no = $_POST['isbn_no'];

    mysqli_query($link, "INSERT INTO tbl_books (category_id, books_name, books_image, isbn_no, books_author_name, books_publication_name, books_purchase_date, books_price, books_quantity, books_availability, added_by) VALUES ('$_POST[category]', '$_POST[booksname]', '$imagepath', '$isbn_no', '$_POST[bauthorname]', '$_POST[bpubname]', '$_POST[bpurcdate]', '$_POST[bprice]', '$_POST[bquantity]', '$_POST[bavailability]', '$_SESSION[username]')");

    ?>
    <script type="text/javascript">
        alert("Book added successfully.");
        window.location = "dashboard.php";
    </script>
    <?php
}
?>
    
<?php 
include 'inc/footer.php';
?>