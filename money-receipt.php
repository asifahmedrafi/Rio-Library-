<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php
            </script>
        <?php
    }
    include 'inc/connection.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Invoice Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="inc/css/money-receipt-style.css" rel="stylesheet">
</head>

<body>
    <table class="body-wrap">
        <tbody>
            <tr>
                <td></td>
                <td class="container" width="600">
                    <div class="content">
                        <?php
                        if (isset($_GET["id"])) {
                            $id = $_GET["id"];

                            $fines = mysqli_query($link, "SELECT 
                                                                    f.id, 
                                                                    f.status, 
                                                                    f.fine, 
                                                                    f.over_due_day,
                                                                    f.interest_per_day,
                                                                    f.total_interest,
                                                                    f.total_fine,
                                                                    f.pay_date, 
                                                                    u.name, 
                                                                    u.utype, 
                                                                    b.books_name 
                                                                FROM tbl_fines AS f 
                                                                JOIN tbl_users AS u ON u.id = f.user_id 
                                                                JOIN tbl_books AS b ON b.id = f.books_id
                                                                WHERE f.id='$id'");

                            $fine = mysqli_fetch_assoc($fines);
                        }


                        ?>
                        <table class="main" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="content-wrap aligncenter">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td class="content-block">
                                                        <h2>Thanks from Rio Library</h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="content-block">
                                                    <table class="invoice">
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $fine["name"]; ?><br>Invoice #<?php echo $id; ?><br><?php echo date("F j, Y", strtotime($fine["pay_date"])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="alignright" width="70%">Book Name</td>
                                                                                <td class="alignright" width="30%"><?php echo $fine["books_name"]; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="alignright" width="70%">Fine</td>
                                                                                <td class="alignright" width="30%">৳ <?php echo number_format($fine["fine"], 2); ?></td>
                                                                            </tr>
                                                                            <tr class="total">
                                                                                <td class="alignright" width="70%">Overdue days</td>
                                                                                <td class="alignright" width="30%"><?php echo $fine["over_due_day"]; ?> Days</td>
                                                                            </tr>
                                                                            <tr class="total">
                                                                                <td class="alignright" width="70%">Interest ( Per Day <?php echo $fine["interest_per_day"]; ?> %)</td>
                                                                                <td class="alignright" width="30%">৳ + <?php echo number_format($fine["total_interest"], 2); ?></td>
                                                                            </tr>
                                                                            <tr class="total">
                                                                                <td class="alignright" width="70%">Total</td>
                                                                                <td class="alignright" width="30%">৳ <?php echo number_format($fine["total_fine"], 2); ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                                <tr>
                                                    <td class="content-block">
                                                        <a href="#">Print</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="content-block">
                                                        Rio Library. Dhanmondi, Dhaka
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>