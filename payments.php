<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
    }

    include 'inc/connection.php';
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $today  = date("Y-m-d");

        mysqli_query($link,"UPDATE tbl_fines SET status='1', pay_date='$today' WHERE id='$id'");
        header("Location: money-receipt.php?id=$id");
    }
?>