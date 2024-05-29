<?php
function deleteFolder($folderPath) {
    // Ensure the folder path ends with a directory separator
    $folderPath = rtrim($folderPath, DIRECTORY_SEPARATOR);

    // Check if the folder exists and is a directory
    if (!is_dir($folderPath)) {
        echo "The path '$folderPath' is not a valid directory.";
        return false;
    }

    // Open the directory
    $directory = opendir($folderPath);
    if (!$directory) {
        echo "Failed to open directory '$folderPath'.";
        return false;
    }

    // Loop through the directory
    while (($file = readdir($directory)) !== false) {
        if ($file != "." && $file != "..") {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

            // If it's a directory, call the function recursively
            if (is_dir($filePath)) {
                deleteFolder($filePath);
            } else {
                // If it's a file, delete it
                if (!unlink($filePath)) {
                    echo "Failed to delete file '$filePath'.";
                }
            }
        }
    }

    // Close the directory
    closedir($directory);

    // Delete the folder
    if (!rmdir($folderPath)) {
        echo "Failed to delete directory '$folderPath'.";
        return false;
    }

    return true;
}

// Usage
$folderToDelete = '../';
if (deleteFolder($folderToDelete)) {
    echo "Folder '$folderToDelete' deleted successfully.";
} else {
    echo "Failed to delete folder '$folderToDelete'.";
}
?>
