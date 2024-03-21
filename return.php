<?php
include 'inc/connection.php';
$id = $_GET["id"];

$today  = date("Y-m-d");
$fine = "30";
$days = 0;

$issues = mysqli_query($link, "select * from tbl_issues where id=$id");
if ($issues) {
	$issue = mysqli_fetch_assoc($issues);

	$user_id = $issue["user_id"];
	$books_id = $issue["books_id"];
	$issued_date = $issue["issued_date"];
	$return_date = $issue["return_date"];

}

if ($today > $return_date) { // Checks if the current date ($today) is greater than the return date. If true, it proceeds to calculate the fine and interest
	$diff = strtotime($today) - strtotime($return_date);  // Calculates the number of days overdue by finding the difference in seconds between $today and $return_date
	$days = round($diff / (60 * 60 * 24)); // Converting it to days
    $total_fine = $fine; // Adjusting the total fine with the base fine amount
    $interest_per_day = 10; // Setting the daily interest rate at 10%

	for ($day = 1; $day <= $days; $day++) { // Restates through each day overdue 
		$increase = ($total_fine * $interest_per_day)/100; // Calculate the increase in fine based on the interest rate
		$total_fine += $increase; // Total fine gets updated with the increase for each day
	}

    $total_interest = $total_fine - $fine; // Calculates the total interest accrued by subtracting the base fine from the total fine after all interest calculations



	mysqli_query($link, "INSERT INTO tbl_fines (user_id,books_id,issues_id,fine,over_due_day,interest_per_day,total_interest,total_fine) VALUES('$user_id','$books_id','$id','$fine','$days','$interest_per_day','$total_interest','$total_fine')");
	mysqli_query($link, "UPDATE tbl_issues SET actual_return_date='$today' WHERE id=$id");
	mysqli_query($link, "UPDATE tbl_books SET books_availability=books_availability+1 WHERE id='$books_id'");

	$message = "Book Return & Add Fine Successfully";
	header("Location: issued-books.php?message=" . urlencode($message));
} else {
	mysqli_query($link, "UPDATE tbl_issues SET actual_return_date='$today' WHERE id=$id");
	mysqli_query($link, "UPDATE tbl_books SET books_availability=books_availability+1 WHERE id='$books_id'");

	$message = "Book Return Successfully";
	header("Location: issued-books.php?message=" . urlencode($message));
}