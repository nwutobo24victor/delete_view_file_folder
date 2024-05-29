<?php
// Database credentials
$host = 'localhost';
$db = 'napec_db';
$user = 'root';
$pass = '';

// File path for backup
$backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Export the database
$command = "mysqldump --host=$host --user=$user --password=$pass $db > $backupFile";
system($command, $output, $return);

if ($return === 0 && file_exists($backupFile)) {
    // Download the backup file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backupFile));
    ob_clean();
    flush();
    readfile($backupFile);

    // Delete the backup file after download
    unlink($backupFile);

    // Connect to MySQL and delete the database
    $conn = new mysqli($host, $user, $pass);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DROP DATABASE $db";
    if ($conn->query($sql) === TRUE) {
        echo "Database deleted successfully.";
    } else {
        echo "Error deleting database: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: Failed to export the database.";
}
?>
