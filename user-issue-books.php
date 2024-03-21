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
    $rdate = date("d/m/Y", strtotime("+30 days"));
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
                        <span class="disabled">user issue book</span>
                    </div>
                </div>
            </div>
            <div class="issueBook">
                <div class="row">
                    <div class="col-md-6">
                        <div class="issue-wrapper">
                            <form action="" class="form-control" method="post" name="reg">
                                <table class="table">
                                    <tr>
                                        <td class="">
                                            <select name="reg_select" id="" class="form-control">
                                                <?php 
                                                    $res= mysqli_query($link, "select regno, username from tbl_users");
                                                    while($row=mysqli_fetch_array($res)){
                                                        echo "<option>";
                                                        echo $row["regno"] . " (" . $row["username"] . ")";
                                                        echo "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-info" value="select" name="submit1">
                                        </td>
                                    </tr>
                                </table>
                                <?php 
                                    if (isset($_POST["submit1"])) {
                                        $res5 = mysqli_query($link, "select * from tbl_users where regno='$_POST[reg_select]' ");
                                        while($row5 = mysqli_fetch_array($res5)){
                                            $name      = $row5['name'];                    
                                            $username  = $row5['username'];
                                            $email     = $row5['email'];
                                            $phone     = $row5['phone'];
                                            $utype     = $row5['utype'];
                                            $regno     = $row5['regno'];
                                            $_SESSION["utype"]     = $utype;
                                            $_SESSION["regno"]     = $regno;
                                            $_SESSION["susername"] = $username;
                                        }
                                    ?>
                                    <table class="table table-bordered">
                                         <tr>
                                            <td>
                                               <input type="text" class="form-control" name="utype" value="<?php echo $utype; ?>" disabled> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="regno" value="<?php echo $regno; ?>"  disabled> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="phone"  value="<?php echo $phone; ?>"> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="mail"  value="<?php echo $email; ?>"> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="booksname" class="form-control">
                                                    <?php 
                                                        $res= mysqli_query($link, "select books_name from tbl_books");
                                                        while($row=mysqli_fetch_array($res)){
                                                            echo "<option>";
                                                            echo $row["books_name"];
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="booksissuedate"  value="<?php echo date("d/m/Y"); ?>"> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="booksreturndate"  value="<?php echo $rdate; ?>"> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="username"  value="<?php echo $username; ?>" disabled> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="submit" name="submit2" class="btn btn-info" value="Issue Book"> 
                                            </td>
                                        </tr>
                                    </table>
                                <?php
                                }
                                ?>
                            </form>

                            <?php
                                if (isset($_POST["submit2"])) {
                                    $qty=0;
                                    $res= mysqli_query($link, "select * from tbl_books where books_name='$_POST[booksname]' ");
                                    while($row = mysqli_fetch_array($res)){
                                        $qty= $row["books_availability"];
                                    }
                                    if ($qty==0) {
                                        ?>
                                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                            <strong style="">This book is not available.</strong>
                                        </div>
                                        <?php  
                                    }
                                    else{
                                        mysqli_query($link, "insert into tbl_issues values('','$_SESSION[utype]','$_SESSION[regno]','$_POST[name]','$_POST[phone]','$_POST[mail]','$_POST[booksname]','$_POST[booksissuedate]','$_POST[booksreturndate]','$_SESSION[susername]') ");
                                        mysqli_query($link, "update tbl_books set books_availability=books_availability-1 where books_name='$_POST[booksname]'");
                                        ?>
                                        <script type="text/javascript">
                                            alert("book issued successfully");
                                            window.location.href=window.location.href;
                                        </script>
                                        <?php
                                    }
                                }
                            ?>
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