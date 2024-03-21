<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

// Directory to save the backup file
$backupDirectory = "backup/";

// Ensure the directory exists, create it if it doesn't
if (!file_exists($backupDirectory)) {
    mkdir($backupDirectory, 0777, true);
}

// Backup file name and path
$backupFile = $backupDirectory . 'backup_' . date("Y-m-d_H-i-s") . '.sql';

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch database structure and data
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Write database structure and data to backup file
$handle = fopen($backupFile, 'w');
foreach ($tables as $table) {
    $result = $conn->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $sql = "INSERT INTO $table (";
        $sql .= implode(", ", array_keys($row)) . ") VALUES (";
        $sql .= "'" . implode("', '", array_values($row)) . "');\n";
        fwrite($handle, $sql);
    }
}
fclose($handle);

$result = mysqli_query($conn, "insert into tbl_files (name) values('$backupFile')");
// Close database connection
$conn->close();

if($result) {
    header('location: backup-list.php');
}
?>