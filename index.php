<?php
    session_start();
    include 'inc/connection.php';

    // Check if a search query is submitted
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        
        // Perform a database query using the $search variable to search for books
        // You can modify this code based on your database structure and search logic
        
        // Example query: SELECT * FROM tbl_books WHERE books_name LIKE '%$search%'
        
        // Store the search results in a variable (e.g., $searchResults)
        $searchResults = mysqli_query($link, "SELECT * FROM tbl_books WHERE books_name LIKE '%$search%'");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="icon" type="image/png" href="dist/img/favicon.ico">
    <link rel="stylesheet" href="user/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="user/dist/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="user/dist/css/owl.carousel.min.css">
    <link rel="stylesheet" href="user/dist/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="user/dist/css/animate.css">
    <link rel="stylesheet" href="user/dist/css/main.css">
</head>

<body>
    <div class="header">
		<div class="container">
			<div class="row">
				<div class="col-3">
					<div class="logo">
						<img src="user/dist/img/1.png" alt="logo">
					</div>
				</div>
				<div class="col-9">
					<div class="header-right">
						<ul>
							<li>
                                <form method="GET">
                                    <input type="text" name="search" placeholder="Search books...">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </li>
							<li><a href="index.php">Home</a></li>
							<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                                <ul class="dropdown-menu">
                                    <li><a href="user/user/login.php">User Login</a></li>
                                    <li><a href="user/librarian/login.php">Librarian Login</a></li>
                                </ul>
                            </li>
							<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign Up</a>
                                <ul class="dropdown-menu">
                                    <li><a href="user/user/registration.php">User Registration</a></li>
                                    <li><a href="user/librarian/registration.php">Librarian Registration</a></li>
                                </ul>
                            </li>
							<li><a href="contactus.php">Contact Us</a></li>
							<li><a href="https://www.facebook.com/riolibrary" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://twitter.com/RioHondoLibrary" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="https://www.linkedin.com/company/rio-rancho-library" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						</ul>		
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Start slider -->
    <div class="slider">
        <div class="slide-carousel owl-carousel">
            <div class="item" style="background-image:url(user/dist/img/3.jpg);">
                <div class="overlay"></div>
                <div class="text">
                    <div class="this-item">
                        <h2>welcome to rio library</h2>
                    </div>
                    <div class="this-item">
                        <h3>It is a long established fact that a reader will be distracted by the readable.</h3>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image:url(user/dist/img/2.jpg);">
                <div class="overlay"></div>
                <div class="text">
                    <div class="this-item">
                        <h2>welcome to rio library</h2>
                    </div>
                    <div class="this-item">
                        <h3>It is a long established fact that a reader will be distracted by the readable.</h3>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image:url(user/dist/img/1.jpg);">
                <div class="overlay"></div>
                <div class="text">
                    <div class="this-item">
                        <h2>welcome to rio library</h2>
                    </div>
                    <div class="this-item">
                        <h3>It is a long established fact that a reader will be distracted by the readable.</h3>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image:url(user/dist/img/4.jpg);">
                <div class="overlay"></div>
                <div class="text">
                    <div class="this-item">
                        <h2>welcome to rio library</h2>
                    </div>
                    <div class="this-item">
                        <h3>It is a long established fact that a reader will be distracted by the readable.</h3>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image:url(user/dist/img/5.jpg);">
                <div class="overlay"></div>
                <div class="text">
                    <div class="this-item">
                        <h2>welcome to rio library</h2>
                    </div>
                    <div class="this-item">
                        <h3>It is a long established fact that a reader will be distracted by the readable.</h3>
                    </div>
                </div>
            </div>
            <div class="item" style="background-image:url(user/dist/img/6.jpg);">
                <div class="overlay"></div>
                <div class="text">
                    <div class="this-item">
                        <h2>welcome to rio library</h2>
                    </div>
                    <div class="this-item">
                        <h3>It is a long established fact that a reader will be distracted by the readable.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book section -->
    <div class="book">
        <?php if(isset($searchResults)): ?>
            <div class="container">
                <div class="row">
                    <?php foreach ($searchResults as $book): ?>
                        <div class="col-md-3" style="margin-bottom: 35px;">
                            <img src="<?php echo $book["books_image"]; ?> " alt="<?php echo $book["books_name"]; ?>" width="100%" height="300">
                            <h6 style="font-size: 15px;"><?php echo $book["books_name"]; ?></h6>
                            <p><span>Available: </span><?php echo $book["books_availability"]; ?></p>
                            <a href="user/user/requests.php?books_id=<?php echo $book["id"]; ?>" class="btn btn-primary btn-sm">Request Book</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="row">
                    <?php
                        $res = mysqli_query($link, "select * from tbl_books where books_availability>0");
                        foreach ($res as $book):
                    ?>
                        <div class="col-md-3" style="margin-bottom: 35px;">
                            <img src="<?php echo $book["books_image"]; ?> " alt="<?php echo $book["books_name"]; ?>" width="100%" height="300">
                            <h6 style="font-size: 15px;"><?php echo $book["books_name"]; ?></h6>
                            <p><span>Available: </span><?php echo $book["books_availability"]; ?></p>
                            <a href="user/user/requests.php?books_id=<?php echo $book["id"]; ?>" class="btn btn-primary btn-sm">Request Book</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer section -->
    <div class="footer text-center bg-secondary">
        <p style="margin: 0;">&copy; All rights reserved</p>
    </div>

    <script src="user/dist/js/jquery-2.2.4.min.js"></script>
    <script src="user/dist/js/bootstrap.min.js"></script>
    <script src="user/dist/js/fontawesome.min.js"></script>
    <script src="user/dist/js/owl.carousel.min.js"></script>
    <script src="user/dist/js/owl.animate.js"></script>
    <script src="user/dist/js/custom.js"></script>
</body>

</html>