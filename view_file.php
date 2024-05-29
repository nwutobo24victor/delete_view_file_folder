<?php
$directory = './upload';
$files = scandir($directory);

echo '<h1>Directory Listing</h1>';
echo '<ul>';
foreach($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo '<li>' . $file . '</li>';
    }
}
echo '</ul>';
?>
