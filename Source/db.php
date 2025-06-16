<?php

$connection = mysqli_connect('localhost', 'root', '', 'web3');
mysqli_query($connection, "SET NAMES 'utf8'");

if (!$connection) {
    exit('Kết nối không thành công!');
}
?>