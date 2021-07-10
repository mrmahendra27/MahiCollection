<?php
//database connection
$connection = mysqli_connect('localhost', 'test', 'test', 'mahi_collection');

//check connection
if (!$connection) {
    echo "Connection Error " . mysqli_connect_error();
}
?>